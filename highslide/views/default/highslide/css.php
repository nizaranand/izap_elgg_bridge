<?php
	/**
	 * highslide CSS extender
	 */
?>

/* ----------- Slideshow addon for highslide By Dr.Sanu P Moideen @ Team webgalli ---------------- */


.highslide-container div {
    font-family: Tahoma, Verdana, Arial
	font-size: 10pt;
}
.highslide-container table {
	background: none;
}
.highslide {
	outline: none;
	text-decoration: none;
}
.highslide img {
}
.highslide:hover img {
}
.highslide-active-anchor img {
	visibility: hidden;
}
.highslide-gallery .highslide-active-anchor img {
	border-color: black;
	visibility: visible;
	cursor: default;
}
.highslide-image {
	border-width: 2px;
	border-style: solid;
	border-color: white;
	background: gray;
}
.highslide-wrapper, .highslide-outline {
	background: white;
}
.glossy-dark {
	background: #111;
}

.highslide-image-blur {
}
.highslide-number {
	font-weight: bold;
	color: gray;
	font-size: .9em;
}
.highslide-caption {
	display: none;
	font-size: 1em;
	padding: 5px;
	/*background: white;*/
}
.highslide-caption a {
	float : right;
    text-decoration :none;
}
.highslide-heading {
	display: none;
	font-weight: bold;
	margin: 0.4em;
}
.highslide-dimming {
	position: absolute;
	background: black;
}
a.highslide-full-expand {
   background: url(<?php echo $vars['url']; ?>mod/highslide/vendors/highslide/graphics/fullexpand.gif) no-repeat;
   display: block;
   margin: 0 10px 10px 0;
   width: 34px;
   height: 34px;
}
.highslide-loading {
	display: block;
	color: black;
	font-size: 9px;
	font-weight: bold;
	text-transform: uppercase;
	text-decoration: none;
	padding: 3px;
	border: 1px solid white;
	background-color: white;
	padding-left: 22px;
	background-image: url(<?php echo $vars['url']; ?>mod/highslide/vendors/highslide/graphics/loader.white.gif);
	background-repeat: no-repeat;
	background-position: 3px 1px;
}
a.highslide-credits,
a.highslide-credits i {
	padding: 2px;
	color: silver;
	text-decoration: none;
	font-size: 10px;
}
a.highslide-credits:hover,
a.highslide-credits:hover i {
	color: white;
	background-color: gray;
}
.highslide-move, .highslide-move * {
	cursor: move;
}

.highslide-viewport {
	display: none;
	position: fixed;
	width: 100%;
	height: 100%;
	z-index: 1;
	background: none;
	left: 0;
	top: 0;
}
.highslide-overlay {
	display: none;
}
.hidden-container {
	display: none;
}
/* Example of a semitransparent, offset closebutton */
.closebutton {
	position: relative;
	top: -15px;
	left: 15px;
	width: 30px;
	height: 30px;
	cursor: pointer;
	background: url(<?php echo $vars['url']; ?>mod/highslide/vendors/highslide/graphics/close.png);
	/* NOTE! For IE6, you also need to update the highslide-ie6.css file. */
}


/*****************************************************************************/
/* Controls for the galleries.											     */
/* Remove these if you are not using a gallery							     */
/*****************************************************************************/
.highslide-controls {
	width: 195px;
	height: 40px;
	background: url(<?php echo $vars['url']; ?>mod/highslide/vendors/highslide/graphics/controlbar-white.gif) 0 -90px no-repeat;
	margin: 20px 15px 10px 0;
}
.highslide-controls ul {
	position: relative;
	left: 15px;
	height: 40px;
	list-style: none;
	margin: 0;
	padding: 0;
	background: url(<?php echo $vars['url']; ?>mod/highslide/vendors/highslide/graphics/controlbar-white.gif) right -90px no-repeat;

}
.highslide-controls li {
	float: left;
	padding: 5px 0;
	margin:0;
	list-style: none;
}
.highslide-controls a {
	background-image: url(<?php echo $vars['url']; ?>mod/highslide/vendors/highslide/graphics/controlbar-white.gif);
	display: block;
	float: left;
	height: 30px;
	width: 30px;
	outline: none;
}
.highslide-controls a.disabled {
	cursor: default;
}
.highslide-controls a.disabled span {
	cursor: default;
}
.highslide-controls a span {
	/* hide the text for these graphic buttons */
	display: none;
	cursor: pointer;
}


/* The CSS sprites for the controlbar - see http://www.google.com/search?q=css+sprites */
.highslide-controls .highslide-previous a {
	background-position: 0 0;
}
.highslide-controls .highslide-previous a:hover {
	background-position: 0 -30px;
}
.highslide-controls .highslide-previous a.disabled {
	background-position: 0 -60px !important;
}
.highslide-controls .highslide-play a {
	background-position: -30px 0;
}
.highslide-controls .highslide-play a:hover {
	background-position: -30px -30px;
}
.highslide-controls .highslide-play a.disabled {
	background-position: -30px -60px !important;
}
.highslide-controls .highslide-pause a {
	background-position: -60px 0;
}
.highslide-controls .highslide-pause a:hover {
	background-position: -60px -30px;
}
.highslide-controls .highslide-next a {
	background-position: -90px 0;
}
.highslide-controls .highslide-next a:hover {
	background-position: -90px -30px;
}
.highslide-controls .highslide-next a.disabled {
	background-position: -90px -60px !important;
}
.highslide-controls .highslide-move a {
	background-position: -120px 0;
}
.highslide-controls .highslide-move a:hover {
	background-position: -120px -30px;
}
.highslide-controls .highslide-full-expand a {
	background-position: -150px 0;
}
.highslide-controls .highslide-full-expand a:hover {
	background-position: -150px -30px;
}
.highslide-controls .highslide-full-expand a.disabled {
	background-position: -150px -60px !important;
}
.highslide-controls .highslide-close a {
	background-position: -180px 0;
}
.highslide-controls .highslide-close a:hover {
	background-position: -180px -30px;
}

.description{
	font-size: 1.2em !important;
	padding: 10px 20px !important;
	width:566px !important;
	margin: 10px auto 0 auto !important;
	background: #EEE !important;
}