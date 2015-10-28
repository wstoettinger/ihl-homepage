SETLOCAL ENABLEDELAYEDEXPANSION
cd img-temp
call :treeProcess
cd ..
SETLOCAL DISABLEDELAYEDEXPANSION

goto :eof

:treeProcess
rem Do whatever you want here over the files of this subdir, for example:
FOR /D %%d IN (*) DO (
  set in="%%d"
  set out=!in!
  
  nconvert -out jpeg -o !out!\%%.jpg -i -rmeta -rexifthumb -overwrite -rtype lanczos -q 80 !in!\*.jpg >nul 2>nul
  nconvert -out png  -o !out!\%%.png -i -rmeta -rexifthumb -overwrite !in!\*.png >nul 2>nul
  
  cd %%d
  call :treeProcess
  cd ..
)