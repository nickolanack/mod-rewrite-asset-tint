mod-rewrite-asset-tint
======================

*requires: EasyImage from https://github.com/nickolanack/EasyImage*

This packages allows a folder to be used for containing tintable icons on an apache server with *mod-rewrite* enabled and
*Allow Overrides* configured so that the .htaccess is read. 

To use this script, create a web accessible folder heirarchy for icons. place the contents of the folder *asset-tint*
from this repo in the root of the folder and easyimage (other repo) somewhere nearby
```
asset-folder/
  .htaccess
  assets.php
  config.json
  
  //put easyimage folder here too
  easyimage/
    easyimage.php
    .htaccess
    
  icon1.png
  icon2.png
  ...
```
