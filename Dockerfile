# syntax=docker/dockerfile:1
FROM alpine:3.23 AS pgbuild
ARG PG_COMMIT=8d87367b39e44b0913ca585c733795cc2d30bff1
RUN ["apk","add","--no-cache","build-base","linux-headers","git","bison","flex","perl","readline-dev","zlib-dev","icu-dev","pkgconf","ca-certificates"]
WORKDIR /src
RUN ["git","clone","--depth","1","--single-branch","--branch","master","https://github.com/postgres/postgres.git","."]
RUN ["sh","-ec","git fetch --depth=1 origin \"$PG_COMMIT\"; git checkout --detach FETCH_HEAD"]
RUN ["./configure","--prefix=/opt/pgsql"]
RUN ["make","-j5"]
RUN ["make","-j5","install"]
RUN ["sh","-ec","git rev-parse HEAD > /opt/pgsql/COMMIT; /opt/pgsql/bin/postgres --version; cat /opt/pgsql/COMMIT"]
RUN ["rm","-rf","/opt/pgsql/include","/opt/pgsql/lib/pgxs","/opt/pgsql/lib/pkgconfig"]
RUN ["find","/opt/pgsql/lib","-type","f","-name","*.a","-delete"]
FROM alpine:3.23
RUN ["apk","add","--no-cache","readline","zlib","icu-libs","icu-data-full"]
COPY --from=pgbuild /opt/pgsql /opt/pgsql
RUN ["addgroup","-S","postgres"]
RUN ["adduser","-S","-G","postgres","postgres"]
RUN ["mkdir","-p","/var/lib/postgresql/data"]
RUN ["chown","-R","postgres:postgres","/var/lib/postgresql"]
ENV PATH="/opt/pgsql/bin:${PATH}"
ENV PGDATA="/var/lib/postgresql/data"
ENV LD_LIBRARY_PATH="/opt/pgsql/lib"
USER postgres
VOLUME ["/var/lib/postgresql"]
EXPOSE 5432
STOPSIGNAL SIGINT
CMD ["/bin/sh","-ec","\
postgres --version; printf 'COMMIT: '; cat /opt/pgsql/COMMIT; \
if [ ! -s \"$PGDATA/PG_VERSION\" ]; then \
: \"${POSTGRES_PASSWORD:?POSTGRES_PASSWORD required}\"; \
umask 077; \
trap 'rm -f /tmp/pgpass' EXIT; \
printf '%s\\n' \"$POSTGRES_PASSWORD\" > /tmp/pgpass; \
initdb -D \"$PGDATA\" --encoding=UTF8 \
--username=\"${POSTGRES_USER:-postgres}\" --pwfile=/tmp/pgpass \
--auth-host=scram-sha-256 --auth-local=scram-sha-256; \
rm -f /tmp/pgpass; \
printf '%s\\n' 'host all all all scram-sha-256' >> \"$PGDATA/pg_hba.conf\"; \
pg_ctl -D \"$PGDATA\" -o \"-c listen_addresses='' -k /tmp\" -w start; \
if [ \"${POSTGRES_DB:-postgres}\" != postgres ]; then \
PGPASSWORD=\"$POSTGRES_PASSWORD\" createdb -h /tmp -U \"${POSTGRES_USER:-postgres}\" -- \"$POSTGRES_DB\"; \
fi; \
pg_ctl -D \"$PGDATA\" -m fast -w stop; \
fi; \
exec postgres -D \"$PGDATA\" -c listen_addresses='*'"]
