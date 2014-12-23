mod-rewrite-asset-tint
======================

*requires: EasyImage from https://github.com/nickolanack/EasyImage*

This packages allows a folder to be used for containing tintable icons on an apache server with *mod-rewrite* enabled and
*Allow Overrides* configured so that the .htaccess is read. 

- To use this script, create a web accessible folder heirarchy for icons. place the contents of the folder *asset-tint*
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
    
  icon1.png //your icons
  icon2.png //could be in sub-directories
  ...
```

- update config.json so that easyimage.php can be found by asset.php (if not located the same as above)
```
{
	easyimage:'./easyimage/easyimage.php'
}
```
- point your browser to yoursite/icons/asset.php asset.php will display any issues or warnings.
- place icons in the root of the folder, or subdirectorys. you can now place images in html, and css ending with ?tint=rgb(r,g,b)
and those icons will be served with the new tint color. 

```css
.button{
	background-image:url(yoursite/icons/icon1.png?tint=rgb(200,10,60));
}

```

```html
<img src="yoursite/icons/icon1.png?tint=rgb(200,10,60)" />
```
