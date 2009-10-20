#!/bin/bash 
#convert ./upload.png -matte -virtual-pixel transparent +distort Perspective \
#'0.5,0 0.5,0  \
# 0.5,200  0.5,200  \
# 150,200 100,156  \
# 150,0 100,30' \
#./uploadp.png
find . -maxdepth 1 -iname '*png' -exec convert \{} -matte -virtual-pixel transparent +distort Perspective \
'0.5,0 0.5,0  \
 0.5,627  0.5,627  \
 653,627 550,527  \
 653,0 550,100' \
./persp/\{} \;