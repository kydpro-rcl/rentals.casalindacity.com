// JavaScript Document

/*
function house(no){
villawindows=dhtmlmodal.open("VillasGallery", "iframe", "tor_pics/album_pictures.php?no="+no, "http://www.casalindacity.com/ - Villa No. "+no, "width=866px,height=499px,center=1,resize=0,scrolling=0", "recal")
	return true
}	*/

function house(no){
villawindows=dhtmlmodal.open("VillasGallery", "iframe", "tor_pics/gallery.php?no="+no, "http://www.casalindacity.com/ - Villa No. "+no, "width=900px,height=529px,center=1,resize=0,scrolling=0", "recal")
	return true
}

function calendar(id){
villawindows=dhtmlmodal.open("VillasGallery", "iframe", "../booking/calendario_una_villa/index.php?v="+id, "http://www.casalindacity.com/", "width=430px,height=360px,center=1,resize=0,scrolling=0", "recal")
	return true
}
