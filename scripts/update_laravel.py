import subprocess, urllib.request
from pathlib import Path
def value(*cmd): return subprocess.run(cmd, check=True, text=True, capture_output=True).stdout.strip()
def show(*cmd): subprocess.run(cmd, check=True)
try:
    if value("git", "branch", "--show-current") != "main": raise RuntimeError("nav main zars")
    if value("git", "remote", "get-url", "origin") != "https://github.com/yl3gbc/Lielvardnieki.git": raise RuntimeError("nepareizs origin")
    if value("git", "status", "--porcelain", "--untracked-files=no"): raise RuntimeError("Git darba koks nav tirs")
    show("git", "fetch", "origin", "main")
    for folder in ("laravel-framework", "laravel-app"):
        show("git", "-C", folder, "fetch", "origin", "13.x")
        show("git", "-C", folder, "merge", "--ff-only", "origin/13.x")
    show("sudo", "docker", "compose", "exec", "-T", "php", "composer", "update", "laravel/framework", "--with-dependencies", "--prefer-source", "--no-interaction", "--no-progress")
    urllib.request.urlopen("https://lielvardnieki.online", timeout=20).read(1)
    refs = "\n".join(f"{f} {value('git', '-C', f, 'rev-parse', 'HEAD')}" for f in ("laravel-framework", "laravel-app"))
    Path("laravel-commits.txt").write_text(refs + "\n", encoding="utf-8")
    show("git", "add", "scripts/update_laravel.py", "laravel-commits.txt")
    if value("git", "diff", "--cached", "--name-only"):
        show("git", "commit", "-m", "Update Laravel 13.x and Framework revision pointers")
    if value("git", "rev-list", "--count", "origin/main..HEAD") != "0":
        show("git", "push", "origin", "main")
    print("OK: Laravel un Framework atjauninati, GitHub atjauninats")
except Exception as error: raise SystemExit(f"KLUDA: {error}")
