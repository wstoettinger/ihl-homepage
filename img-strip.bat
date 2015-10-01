@echo off
SETLOCAL ENABLEDELAYEDEXPANSION
FOR /D /R %%a IN (img-temp\*) DO (
  set in="%%a"
  set out=!in!
  
  nconvert -out jpeg -o !out!\%%.jpg -i -rmeta -rexifthumb -overwrite -rtype lanczos -q 80 !in!\*.jpg >nul 2>nul
  nconvert -out png  -o !out!\%%.png -i -rmeta -rexifthumb -overwrite !in!\*.png >nul 2>nul
)
SETLOCAL DISABLEDELAYEDEXPANSION