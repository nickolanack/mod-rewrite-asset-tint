mod-rewrite-asset-tint
======================
<img src="http://media.geolive.ca/assets/sm_widgets.png" /> + tint =
<img src="http://media.geolive.ca/assets/sm_widgets.png?tint=rgb(29,29,100)" />
<img src="http://media.geolive.ca/assets/sm_widgets.png?tint=rgb(100,29,100)" />
<img src="http://media.geolive.ca/assets/sm_widgets.png?tint=rgb(29,100,100)" />



*requires: EasyImage from https://github.com/nickolanack/EasyImage*

This packages allows a folder to be used for containing tintable icons on an apache server with *mod-rewrite* enabled and
*Allow Overrides* configured so that the .htaccess is read. 

- To use this script, create a web accessible folder heirarchy for icons. place the contents of the folder *asset-tint*
from this repo in the root of the folder and easyimage (other repo) somewhere nearby

###Example folder layout
```
tint-icons/ 
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
//contents of config.json
{
	"easyimage":"./easyimage/easyimage.php"
}
```
- point your browser to yoursite/tint-icons/asset.php (or wherever you put it) asset.php will display any issues or warnings.
- place icons in the root of the folder, or subdirectories. 
- you can now place images in html, and css ending with?tint=rgb(r,g,b) and those icons will be served with the new tint color. 

###Terminal Setup
```bash
mkdir tint-icons
git clone https://github.com/nickolanack/mod-rewrite-asset-tint.git
git clone https://github.com/nickolanack/EasyImage.git

cp mod-rewrite-asset-tint/asset-tint/* tint-icons/
cp mod-rewrite-asset-tint/asset-tint/.htaccess tint-icons/  #this is what routes image queries to assets.php 
cp EasyImage/easyimage/*tint-icons/

#vi tint-icons/config.json #if neccessary

```
###HTML/CSS Usage
```css
.button{
	background-image:url(yoursite/icons/icon1.png?tint=rgb(200,10,60));
}

```

```html
<img src="yoursite/icons/icon1.png?tint=rgb(200,10,60)" />
```
