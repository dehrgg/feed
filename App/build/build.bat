@echo off
set public=%~dp0..\..\public
set js=%public%\js
set css=%public%\css
set stamp=%DATE:~6,4%%DATE:~3,2%%DATE:~0,2%%TIME:~0,2%%TIME:~3,2%

echo Compiling shared templates
node shared_compiler.js

echo Minifying and combining js
pushd %js%
del /F dist\*.min.js
ajaxmin app.js google-feed-provider.js templates\feed.js templates\feedlist.js models\feedlist.js models\feed.js views\pages\search.js views\picklist.js views\feed.js views\feedlist.js views\pin-form.js -out dist\feed.min.js
popd

echo Minifying and combining css
pushd %css%
del /F dist\*.min.css
ajaxmin style.css bootstrap.min.css -out dist\feed.min.css
popd

pause