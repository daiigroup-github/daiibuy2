daiibuy2
========

daiibuy.com version 2

Javascript base url
------
**แก้ไข** themes/homeshop/assets/js/main-script.js
```javascript
var baseUrl = (window.location.host === 'dev') ? 'http://dev/daiibuy2/' : window.location.origin;
```
เปลี่ยน dev เป็น host name ที่ต้องการ (Ex. 192.168.100.8) แต่ไม่ต้องแก้ถ้าเอาไว้ที่ web root
