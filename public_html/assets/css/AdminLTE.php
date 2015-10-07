<?php
header("Content-type: text/css");

require_once('../../../configuration.php');

$site_colour = $site_array['site_colour'];

if (substr($site_colour, 0, 1) === '#') {
$site_colour = substr($site_colour,-6);
}
include_once("csscolor.php");
$base_colour = new CSS_Color($site_colour);

?>

@import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,300italic,400italic,600italic);

@import url(http://fonts.googleapis.com/css?family=Kaushan+Script);
/*! 
 *   AdminLTE v1.0
 *   Author: AlmsaeedStudio.com
 *   License: Please visit http://wrapbootstrap.com for information about 
 *            this theme's license
!*/
/*
    Core: General style
----------------------------
*/
html,
body {
  overflow-x: hidden!important;
  font-family: 'Source Sans Pro', sans-serif;
  -webkit-font-smoothing: antialiased;
  min-height: 100%;
  background: #f9f9f9;
}
a {
  color: #3c8dbc;
}
a:hover,
a:active,
a:focus {
  outline: none;
  text-decoration: none;
  color: #72afd2;
}
/* Layouts */
.wrapper {
  min-height: 100%;
}
.wrapper:before,
.wrapper:after {
  display: table;
  content: " ";
}
.wrapper:after {
  clear: both;
}
/* Header */
body > .header {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1030;
}
/* Define 2 column template */
.right-side,
.left-side {
  min-height: 100%;
  display: block;
}
/*right side - contins main content*/
.right-side {
  background-color: #f9f9f9;
  margin-left: 220px;
}
/*left side - contains sidebar*/
.left-side {
  position: absolute;
  width: 220px;
  top: 0;
}
@media screen and (min-width: 992px) {
  .left-side {
    top: 50px;
  }
  /*Right side strech mode*/
  .right-side.strech {
    margin-left: 0;
  }
  .right-side.strech > .content-header {
    margin-top: 0px;
  }
  /* Left side collapse */
  .left-side.collapse-left {
    left: -220px;
  }
}
/*Give content full width on xs screens*/
@media screen and (max-width: 992px) {
  .right-side {
    margin-left: 0;
  }
}
/*
    By default the layout is not fixed but if you add the class .fixed to the body element
    the sidebar and the navbar will automatically become poisitioned fixed
*/
body.fixed > .header,
body.fixed .left-side,
body.fixed .navbar {
  position: fixed;
}
body.fixed > .header {
  top: 0;
  right: 0;
  left: 0;
}
body.fixed .navbar {
  left: 0;
  right: 0;
}
body.fixed .wrapper {
  margin-top: 50px;
}
/* Content */
.content {
  padding: 20px 15px;
  background: #f9f9f9;
}
/* Utility */
/* H1 - H6 font */
h1,
h2,
h3,
h4,
h5,
h6,
.h1,
.h2,
.h3,
.h4,
.h5,
.h6 {
  font-family: 'Source Sans Pro', sans-serif;
}
/* Page Header */
.page-header {
  margin: 10px 0 20px 0;
  font-size: 22px;
}
.page-header > small {
  color: #666;
  display: block;
  margin-top: 5px;
}
/* All images should be responsive */
img {
  max-width: 100%important;
}
.sort-highlight {
  background: #f4f4f4;
  border: 1px dashed #ddd;
  margin-bottom: 10px;
}
/* 10px padding and margins */
.pad {
  padding: 10px;
}
.margin {
  margin: 10px;
}
/* Display inline */
.inline {
  display: inline;
  width: auto;
}
/* Background colors */
.bg-red,
.bg-yellow,
.bg-aqua,
.bg-blue,
.bg-light-blue,
.bg-green,
.bg-navy,
.bg-teal,
.bg-olive,
.bg-lime,
.bg-orange,
.bg-fuchsia,
.bg-purple,
.bg-maroon,
.bg-black {
  color: #f9f9f9 !important;
}
.bg-gray {
  background-color: #eaeaec !important;
}
.bg-black {
  background-color: #222222 !important;
}
.bg-red {
  background-color: #f56954 !important;
}
.bg-yellow {
  background-color: #f39c12 !important;
}
.bg-aqua {
  background-color: #00c0ef !important;
}
.bg-blue {
  background-color: #0073b7 !important;
}
.bg-light-blue {
  background-color: #3c8dbc !important;
}
.bg-green {
  background-color: #00a65a !important;
}
.bg-navy {
  background-color: #001f3f !important;
}
.bg-teal {
  background-color: #39cccc !important;
}
.bg-olive {
  background-color: #3d9970 !important;
}
.bg-lime {
  background-color: #01ff70 !important;
}
.bg-orange {
  background-color: #ff851b !important;
}
.bg-fuchsia {
  background-color: #f012be !important;
}
.bg-purple {
  background-color: #932ab6 !important;
}
.bg-maroon {
  background-color: #85144b !important;
}
/* Text colors */
.text-red {
  color: #f56954 !important;
}
.text-yellow {
  color: #f39c12 !important;
}
.text-aqua {
  color: #00c0ef !important;
}
.text-blue {
  color: #0073b7 !important;
}
.text-light-blue {
  color: #3c8dbc !important;
}
.text-green {
  color: #00a65a !important;
}
.text-navy {
  color: #001f3f !important;
}
.text-teal {
  color: #39cccc !important;
}
.text-olive {
  color: #3d9970 !important;
}
.text-lime {
  color: #01ff70 !important;
}
.text-orange {
  color: #ff851b !important;
}
.text-fuchsia {
  color: #f012be !important;
}
.text-purple {
  color: #932ab6 !important;
}
.text-maroon {
  color: #85144b !important;
}
/*Hide elements by display none only*/
.hide {
  display: none !important;
}
/* Remove borders */
.no-border {
  border: 0px !important;
}
/* Remove padding */
.no-padding {
  padding: 0px !important;
}
/* Remove margins */
.no-margin {
  margin: 0px !important;
}
/* Remove box shadow */
.no-shadow {
  box-shadow: none!important;
}
/* Don't display when printing */
@media print {
  .no-print {
    display: none;
  }
  .left-side,
  .header,
  .content-header {
    display: none;
  }
  .right-side {
    margin: 0;
  }
}
/* Remove border radius */
.flat,
.flat > * {
  -webkit-border-radius: 0 !important;
  -moz-border-radius: 0 !important;
  border-radius: 0 !important;
}
/* Change the color of the striped tables */
.table-striped > tbody > tr:nth-child(odd) > td,
.table-striped > tbody > tr:nth-child(odd) > th {
  background-color: #f3f4f5;
}
/* .text-center in tables */
table.text-center td,
table.text-center th {
  text-align: center;
}
/* _fix for sparkline tooltip */
.jqstooltip {
  padding: 5px!important;
  width: auto!important;
  height: auto!important;
}
/*
    Components: navbar, logo and content header
-------------------------------------------------
*/
body > .header {
  position: relative;
  max-height: 100px;
  z-index: 1030;
}
body > .header .navbar {
  height: 50px;
  margin-bottom: 0;
  margin-left: 220px;
}
body > .header .navbar .sidebar-toggle {
  float: left;
  padding: 9px 5px;
  margin-top: 8px;
  margin-right: 0;
  margin-bottom: 8px;
  margin-left: 5px;
  background-color: transparent;
  background-image: none;
  border: 1px solid transparent;
  -webkit-border-radius: 0 !important;
  -moz-border-radius: 0 !important;
  border-radius: 0 !important;
}
body > .header .navbar .sidebar-toggle:hover .icon-bar {
  background: #f6f6f6;
}
body > .header .navbar .sidebar-toggle .icon-bar {
  display: block;
  width: 22px;
  height: 2px;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
}
body > .header .navbar .sidebar-toggle .icon-bar + .icon-bar {
  margin-top: 4px;
}
body > .header .navbar .nav > li.user > a {
  font-weight: bold;
}
body > .header .navbar .nav > li.user > a > .fa,
body > .header .navbar .nav > li.user > a > .glyphicon,
body > .header .navbar .nav > li.user > a > .ion {
  margin-right: 5px;
}
body > .header .navbar .nav > li > a > .label {
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  position: absolute;
  top: 7px;
  right: 2px;
  font-size: 10px;
  font-weight: normal;
  width: 15px;
  height: 15px;
  line-height: 1.0em;
  text-align: center;
  padding: 2px;
}
body > .header .navbar .nav > li > a:hover > .label {
  top: 3px;
}
body > .header .logo {
  float: left;
  font-size: 20px;
  line-height: 50px;
  text-align: center;
  padding: 0 10px;
  width: 220px;
  font-family: 'Kaushan Script', cursive;
  font-weight: 500;
  height: 50px;
  display: block;
}
body > .header .logo .icon {
  margin-right: 10px;
}
.right-side > .content-header {
  position: relative;
  padding: 15px 15px 10px 20px;
  background: #fbfbfb;
  box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
}
.right-side > .content-header > h1 {
  margin: 0;
  font-size: 24px;
}
.right-side > .content-header > h1 > small {
  font-size: 15px;
  display: inline-block;
  padding-left: 4px;
  font-weight: 300;
}
.right-side > .content-header > .breadcrumb {
  float: right;
  background: transparent;
  margin-top: 0px;
  margin-bottom: 0;
  font-size: 12px;
  padding: 7px 5px;
  position: absolute;
  top: 15px;
  right: 10px;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
}
.right-side > .content-header > .breadcrumb > li > a {
  color: #444;
  text-decoration: none;
}
.right-side > .content-header > .breadcrumb > li > a > .fa,
.right-side > .content-header > .breadcrumb > li > a > .glyphicon,
.right-side > .content-header > .breadcrumb > li > a > .ion {
  margin-right: 5px;
}
.right-side > .content-header > .breadcrumb > li + li:before {
  content: '>\00a0';
}
@media screen and (max-width: 767px) {
  .right-side > .content-header > .breadcrumb {
    position: relative;
    margin-top: 5px;
    top: 0;
    right: 0;
    float: none;
    background: #efefef;
  }
}
@media (max-width: 767px) {
  .navbar .navbar-nav > li {
    float: left;
  }
  .navbar-nav {
    margin: 0;
    float: left;
  }
  .navbar-nav > li > a {
    padding-top: 15px;
    padding-bottom: 15px;
    line-height: 20px;
  }
  .navbar .navbar-right {
    float: right;
  }
}
@media screen and (max-width: 560px) {
  body > .header {
    position: relative;
  }
  body > .header .logo,
  body > .header .navbar {
    width: 100%;
    float: none;
    position: relative!important;
  }
  body > .header .navbar {
    margin: 0;
  }
  body.fixed > .header {
    position: fixed;
  }
  body.fixed > .wrapper,
  body.fixed .sidebar-offcanvas {
    margin-top: 100px!important;
  }
}
/*
    Component: Sidebar
--------------------------
*/
.sidebar {
  margin-bottom: 5px;
}
.sidebar .sidebar-form input:focus {
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
  border-color: transparent!important;
}
.sidebar .sidebar-menu {
  list-style: none;
  margin: 0;
  padding: 0;
}
.sidebar .sidebar-menu > li {
  margin: 0;
  padding: 0;
}
.sidebar .sidebar-menu > li > a {
  padding: 12px 5px 12px 15px;
  display: block;
}
.sidebar .sidebar-menu > li > a > .fa,
.sidebar .sidebar-menu > li > a > .glyphicon,
.sidebar .sidebar-menu > li > a > .ion {
  width: 20px;
}
.sidebar .sidebar-menu .treeview-menu {
  display: none;
  list-style: none;
  padding: 0;
  margin: 0;
}
.sidebar .sidebar-menu .treeview-menu > li {
  margin: 0;
}
.sidebar .sidebar-menu .treeview-menu > li > a {
  padding: 5px 5px 5px 15px;
  display: block;
  font-size: 14px;
  margin: 0px 0px;
}
.sidebar .sidebar-menu .treeview-menu > li > a > .fa,
.sidebar .sidebar-menu .treeview-menu > li > a > .glyphicon,
.sidebar .sidebar-menu .treeview-menu > li > a > .ion {
  width: 20px;
}
.user-panel {
  padding: 10px;
}
.user-panel:before,
.user-panel:after {
  display: table;
  content: " ";
}
.user-panel:after {
  clear: both;
}
.user-panel > .image > img {
  width: 45px;
  height: 45px;
}
.user-panel > .info {
  font-weight: 600;
  padding: 5px 5px 5px 15px;
  font-size: 14px;
  line-height: 1;
}
.user-panel > .info > p {
  margin-bottom: 9px;
}
.user-panel > .info > a {
  text-decoration: none;
  padding-right: 5px;
  margin-top: 3px;
  font-size: 11px;
  font-weight: normal;
}
.user-panel > .info > a > .fa,
.user-panel > .info > a > .ion,
.user-panel > .info > a > .glyphicon {
  margin-right: 3px;
}
/*
 * Off Canvas
 * --------------------------------------------------
 *  Gives us the push menu effect
 */
@media screen and (max-width: 992px) {
  .relative {
    position: relative;
  }
  .row-offcanvas-right .sidebar-offcanvas {
    right: -220px;
  }
  .row-offcanvas-left .sidebar-offcanvas {
    left: -220px;
  }
  .row-offcanvas-right.active {
    right: 220px;
  }
  .row-offcanvas-left.active {
    left: 220px;
  }
  .sidebar-offcanvas {
    left: 0;
  }
  body.fixed .sidebar-offcanvas {
    margin-top: 50px;
    left: -220px;
  }
  body.fixed .row-offcanvas-left.active .navbar {
    left: 220px !important;
    right: 0;
  }
  body.fixed .row-offcanvas-left.active .sidebar-offcanvas {
    left: 0px;
  }
}
/* 
    Dropdown menus
----------------------------
*/
/*Dropdowns in general*/
.dropdown-menu {
  -webkit-box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
  -moz-box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
  box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
  z-index: 2300;
}
.dropdown-menu > li > a > .glyphicon,
.dropdown-menu > li > a > .fa,
.dropdown-menu > li > a > .ion {
  margin-right: 10px;
}
.dropdown-menu > li > a:hover {
  background-color: #3c8dbc;
  color: #f9f9f9;
}
/*Drodown in navbars*/
.skin-blue .navbar .dropdown-menu > li > a {
  color: #444444;
}
/*
    Navbar custom dropdown menu
------------------------------------
*/
.navbar-nav > .notifications-menu > .dropdown-menu,
.navbar-nav > .messages-menu > .dropdown-menu,
.navbar-nav > .tasks-menu > .dropdown-menu {
  width: 280px;
  padding: 0 0 0 0!important;
  margin: 0!important;
  top: 100%;
  border: 1px solid #dfdfdf;
  -webkit-border-radius: 4px !important;
  -moz-border-radius: 4px !important;
  border-radius: 4px !important;
}
.navbar-nav > .notifications-menu > .dropdown-menu > li.header,
.navbar-nav > .messages-menu > .dropdown-menu > li.header,
.navbar-nav > .tasks-menu > .dropdown-menu > li.header {
  -webkit-border-top-left-radius: 4px;
  -webkit-border-top-right-radius: 4px;
  -webkit-border-bottom-right-radius: 0;
  -webkit-border-bottom-left-radius: 0;
  -moz-border-radius-topleft: 4px;
  -moz-border-radius-topright: 4px;
  -moz-border-radius-bottomright: 0;
  -moz-border-radius-bottomleft: 0;
  border-top-left-radius: 4px;
  border-top-right-radius: 4px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
  background-color: #ffffff;
  padding: 7px 10px;
  border-bottom: 1px solid #f4f4f4;
  color: #444444;
  font-size: 14px;
}
.navbar-nav > .notifications-menu > .dropdown-menu > li.header:after,
.navbar-nav > .messages-menu > .dropdown-menu > li.header:after,
.navbar-nav > .tasks-menu > .dropdown-menu > li.header:after {
  bottom: 100%;
  left: 92%;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
  border-color: rgba(255, 255, 255, 0);
  border-bottom-color: #ffffff;
  border-width: 7px;
  margin-left: -7px;
}
.navbar-nav > .notifications-menu > .dropdown-menu > li.footer > a,
.navbar-nav > .messages-menu > .dropdown-menu > li.footer > a,
.navbar-nav > .tasks-menu > .dropdown-menu > li.footer > a {
  -webkit-border-top-left-radius: 0px;
  -webkit-border-top-right-radius: 0px;
  -webkit-border-bottom-right-radius: 4px;
  -webkit-border-bottom-left-radius: 4px;
  -moz-border-radius-topleft: 0px;
  -moz-border-radius-topright: 0px;
  -moz-border-radius-bottomright: 4px;
  -moz-border-radius-bottomleft: 4px;
  border-top-left-radius: 0px;
  border-top-right-radius: 0px;
  border-bottom-right-radius: 4px;
  border-bottom-left-radius: 4px;
  font-size: 12px;
  background-color: #f4f4f4;
  padding: 7px 10px;
  border-bottom: 1px solid #eeeeee;
  color: #444444;
  text-align: center;
}
.navbar-nav > .notifications-menu > .dropdown-menu > li.footer > a:hover,
.navbar-nav > .messages-menu > .dropdown-menu > li.footer > a:hover,
.navbar-nav > .tasks-menu > .dropdown-menu > li.footer > a:hover {
  background: #f4f4f4;
  text-decoration: none;
  font-weight: normal;
}
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu,
.navbar-nav > .messages-menu > .dropdown-menu > li .menu,
.navbar-nav > .tasks-menu > .dropdown-menu > li .menu {
  margin: 0;
  padding: 0;
  list-style: none;
  overflow-x: hidden;
}
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a,
.navbar-nav > .messages-menu > .dropdown-menu > li .menu > li > a,
.navbar-nav > .tasks-menu > .dropdown-menu > li .menu > li > a {
  display: block;
  white-space: nowrap;
  /* Prevent text from breaking */

  border-bottom: 1px solid #f4f4f4;
}
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a:hover,
.navbar-nav > .messages-menu > .dropdown-menu > li .menu > li > a:hover,
.navbar-nav > .tasks-menu > .dropdown-menu > li .menu > li > a:hover {
  background: #f6f6f6;
  text-decoration: none;
}
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a {
  font-size: 12px;
  color: #444444;
}
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a > .glyphicon,
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a > .fa,
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a > .ion {
  font-size: 20px;
  width: 50px;
  text-align: center;
  padding: 15px 0px;
  margin-right: 5px;
  /* Default background and font colors */

  background: #00c0ef;
  color: #f9f9f9;
  /* Fallback for browsers that doesn't support rgba */

  color: rgba(255, 255, 255, 0.7);
}
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a > .glyphicon.danger,
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a > .fa.danger,
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a > .ion.danger {
  background: #f56954;
}
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a > .glyphicon.warning,
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a > .fa.warning,
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a > .ion.warning {
  background: #f39c12;
}
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a > .glyphicon.success,
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a > .fa.success,
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a > .ion.success {
  background: #00a65a;
}
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a > .glyphicon.info,
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a > .fa.info,
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a > .ion.info {
  background: #00c0ef;
}
.navbar-nav > .messages-menu > .dropdown-menu > li .menu > li > a {
  margin: 0px;
  line-height: 20px;
  padding: 10px 5px 10px 5px;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
}
.navbar-nav > .messages-menu > .dropdown-menu > li .menu > li > a > div > img {
  margin: auto 10px auto auto;
  width: 40px;
  height: 40px;
  border: 1px solid #dddddd;
}
.navbar-nav > .messages-menu > .dropdown-menu > li .menu > li > a > h4 {
  padding: 0;
  margin: 0 0 0 45px;
  color: #444444;
  font-size: 15px;
}
.navbar-nav > .messages-menu > .dropdown-menu > li .menu > li > a > h4 > small {
  color: #999999;
  font-size: 10px;
  float: right;
}
.navbar-nav > .messages-menu > .dropdown-menu > li .menu > li > a > p {
  margin: 0 0 0 45px;
  font-size: 12px;
  color: #888888;
}
.navbar-nav > .messages-menu > .dropdown-menu > li .menu > li > a:before,
.navbar-nav > .messages-menu > .dropdown-menu > li .menu > li > a:after {
  display: table;
  content: " ";
}
.navbar-nav > .messages-menu > .dropdown-menu > li .menu > li > a:after {
  clear: both;
}
.navbar-nav > .tasks-menu > .dropdown-menu > li .menu > li > a {
  padding: 10px;
}
.navbar-nav > .tasks-menu > .dropdown-menu > li .menu > li > a > h3 {
  font-size: 14px;
  padding: 0;
  margin: 0 0 10px 0;
  color: #666666;
}
.navbar-nav > .tasks-menu > .dropdown-menu > li .menu > li > a > .progress {
  padding: 0;
  margin: 0;
}
.navbar-nav > .user-menu > .dropdown-menu {
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
  padding: 1px 0 0 0;
  border-top-width: 0;
  width: 280px;
}
.navbar-nav > .user-menu > .dropdown-menu:after {
  bottom: 100%;
  right: 10px;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
  border-color: rgba(255, 255, 255, 0);
  border-bottom-color: #ffffff;
  border-width: 10px;
  margin-left: -10px;
}
.navbar-nav > .user-menu > .dropdown-menu > li.user-header {
  height: 175px;
  padding: 10px;
  background: #3c8dbc;
  text-align: center;
}
.navbar-nav > .user-menu > .dropdown-menu > li.user-header > img {
  z-index: 5;
  height: 90px;
  width: 90px;
  border: 8px solid;
  border-color: transparent;
  border-color: rgba(255, 255, 255, 0.2);
}
.navbar-nav > .user-menu > .dropdown-menu > li.user-header > p {
  z-index: 5;
  color: #f9f9f9;
  color: rgba(255, 255, 255, 0.8);
  font-size: 17px;
  text-shadow: 2px 2px 3px #333333;
  margin-top: 10px;
}
.navbar-nav > .user-menu > .dropdown-menu > li.user-header > p > small {
  display: block;
  font-size: 12px;
}
.navbar-nav > .user-menu > .dropdown-menu > li.user-body {
  padding: 15px;
  border-bottom: 1px solid #f4f4f4;
  border-top: 1px solid #dddddd;
}
.navbar-nav > .user-menu > .dropdown-menu > li.user-body:before,
.navbar-nav > .user-menu > .dropdown-menu > li.user-body:after {
  display: table;
  content: " ";
}
.navbar-nav > .user-menu > .dropdown-menu > li.user-body:after {
  clear: both;
}
.navbar-nav > .user-menu > .dropdown-menu > li.user-body > div > a {
  color: #0073b7;
}
.navbar-nav > .user-menu > .dropdown-menu > li.user-footer {
  background-color: #f9f9f9;
  padding: 10px;
}
.navbar-nav > .user-menu > .dropdown-menu > li.user-footer:before,
.navbar-nav > .user-menu > .dropdown-menu > li.user-footer:after {
  display: table;
  content: " ";
}
.navbar-nav > .user-menu > .dropdown-menu > li.user-footer:after {
  clear: both;
}
.navbar-nav > .user-menu > .dropdown-menu > li.user-footer .btn-default {
  color: #666666;
}
/* Add fade animation to dropdown menus */
.open > .dropdown-menu {
  animation-name: fadeAnimation;
  animation-duration: .7s;
  animation-iteration-count: 1;
  animation-timing-function: ease;
  animation-fill-mode: forwards;
  -webkit-animation-name: fadeAnimation;
  -webkit-animation-duration: .7s;
  -webkit-animation-iteration-count: 1;
  -webkit-animation-timing-function: ease;
  -webkit-animation-fill-mode: forwards;
  -moz-animation-name: fadeAnimation;
  -moz-animation-duration: .7s;
  -moz-animation-iteration-count: 1;
  -moz-animation-timing-function: ease;
  -moz-animation-fill-mode: forwards;
}
@keyframes fadeAnimation {
  from {
    opacity: 0;
    top: 120%;
  }
  to {
    opacity: 1;
    top: 100%;
  }
}
@-webkit-keyframes fadeAnimation {
  from {
    opacity: 0;
    top: 120%;
  }
  to {
    opacity: 1;
    top: 100%;
  }
}
/* Fix dropdown menu for small screens to display correctly on small screens */
@media screen and (max-width: 767px) {
  .navbar-nav > .notifications-menu > .dropdown-menu,
  .navbar-nav > .user-menu > .dropdown-menu,
  .navbar-nav > .tasks-menu > .dropdown-menu,
  .navbar-nav > .messages-menu > .dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    left: auto;
    border-right: 1px solid #dddddd;
    border-bottom: 1px solid #dddddd;
    border-left: 1px solid #dddddd;
    background: #ffffff;
  }
}
/* Fix menu positions on xs screens to appear correctly and fully */
@media screen and (max-width: 480px) {
  .navbar-nav > .notifications-menu > .dropdown-menu > li.header,
  .navbar-nav > .tasks-menu > .dropdown-menu > li.header,
  .navbar-nav > .messages-menu > .dropdown-menu > li.header {
    /* Remove arrow from the top */
  }
  .navbar-nav > .notifications-menu > .dropdown-menu > li.header:after,
  .navbar-nav > .tasks-menu > .dropdown-menu > li.header:after,
  .navbar-nav > .messages-menu > .dropdown-menu > li.header:after {
    border-width: 0px!important;
  }
  .navbar-nav > .tasks-menu > .dropdown-menu {
    position: absolute;
    right: -120px;
    left: auto;
  }
  .navbar-nav > .notifications-menu > .dropdown-menu {
    position: absolute;
    right: -170px;
    left: auto;
  }
  .navbar-nav > .messages-menu > .dropdown-menu {
    position: absolute;
    right: -210px;
    left: auto;
  }
}
/* 
   All form elements including input, select, textarea etc.
-----------------------------------------------------------------
*/
.form-control {
  -webkit-border-radius: 0px !important;
  -moz-border-radius: 0px !important;
  border-radius: 0px !important;
  box-shadow: none;
}
.form-control:focus {
  border-color: #3c8dbc !important;
  box-shadow: none;
}
.form-group.has-success label {
  color: #00a65a;
}
.form-group.has-success .form-control {
  border-color: #00a65a !important;
  box-shadow: none;
}
.form-group.has-warning label {
  color: #f39c12;
}
.form-group.has-warning .form-control {
  border-color: #f39c12 !important;
  box-shadow: none;
}
.form-group.has-error label {
  color: #f56954;
}
.form-group.has-error .form-control {
  border-color: #f56954 !important;
  box-shadow: none;
}
/* Input group */
.input-group .input-group-addon {
  border-radius: 0;
  background-color: #f4f4f4;
}
/* button groups */
.btn-group-vertical .btn.btn-flat:first-of-type,
.btn-group-vertical .btn.btn-flat:last-of-type {
  border-radius: 0;
}
/* Checkbox and radio inputs */
.checkbox,
.radio {
  padding-left: 0;
}
/* 
    Compenent: Progress bars
--------------------------------
*/
/* size variation */
.progress.sm {
  height: 10px;
}
.progress.xs {
  height: 7px;
}
/* Vertical bars */
.progress.vertical {
  position: relative;
  width: 30px;
  height: 200px;
  display: inline-block;
  margin-right: 10px;
}
.progress.vertical > .progress-bar {
  width: 100%!important;
  position: absolute;
  bottom: 0;
}
.progress.vertical.sm {
  width: 20px;
}
.progress.vertical.xs {
  width: 10px;
}
/* Remove margins from progress bars when put in a table */
.table tr > td .progress {
  margin: 0;
}
.progress-bar-light-blue,
.progress-bar-primary {
  background-color: #3c8dbc;
}
.progress-striped .progress-bar-light-blue,
.progress-striped .progress-bar-primary {
  background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));
  background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
}
.progress-bar-green,
.progress-bar-success {
  background-color: #00a65a;
}
.progress-striped .progress-bar-green,
.progress-striped .progress-bar-success {
  background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));
  background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
}
.progress-bar-aqua,
.progress-bar-info {
  background-color: #00c0ef;
}
.progress-striped .progress-bar-aqua,
.progress-striped .progress-bar-info {
  background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));
  background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
}
.progress-bar-yellow,
.progress-bar-warning {
  background-color: #f39c12;
}
.progress-striped .progress-bar-yellow,
.progress-striped .progress-bar-warning {
  background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));
  background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
}
.progress-bar-red,
.progress-bar-danger {
  background-color: #f56954;
}
.progress-striped .progress-bar-red,
.progress-striped .progress-bar-danger {
  background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));
  background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
}
/*
    Component: Small boxes
*/
.small-box {
  position: relative;
  display: block;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
  margin-bottom: 15px;
}
.small-box > .inner {
  padding: 10px;
}
.small-box > .small-box-footer {
  position: relative;
  text-align: center;
  padding: 3px 0;
  color: #fff;
  color: rgba(255, 255, 255, 0.8);
  display: block;
  z-index: 10;
  background: rgba(0, 0, 0, 0.1);
  text-decoration: none;
}
.small-box > .small-box-footer:hover {
  color: #fff;
  background: rgba(0, 0, 0, 0.15);
}
.small-box h3 {
  font-size: 38px;
  font-weight: bold;
  margin: 0 0 10px 0;
  white-space: nowrap;
  padding: 0;
}
.small-box p {
  font-size: 15px;
}
.small-box p > small {
  display: block;
  color: #f9f9f9;
  font-size: 13px;
  margin-top: 5px;
}
.small-box h3,
.small-box p {
  z-index: 5px;
}
.small-box .icon {
  position: absolute;
  top: auto;
  bottom: 5px;
  right: 5px;
  z-index: 0;
  font-size: 90px;
  color: rgba(0, 0, 0, 0.15);
}
.small-box:hover {
  text-decoration: none;
  color: #f9f9f9;
}
.small-box:hover .icon {
  animation-name: tansformAnimation;
  animation-duration: .5s;
  animation-iteration-count: 1;
  animation-timing-function: ease;
  animation-fill-mode: forwards;
  -webkit-animation-name: tansformAnimation;
  -webkit-animation-duration: .5s;
  -webkit-animation-iteration-count: 1;
  -webkit-animation-timing-function: ease;
  -webkit-animation-fill-mode: forwards;
  -moz-animation-name: tansformAnimation;
  -moz-animation-duration: .5s;
  -moz-animation-iteration-count: 1;
  -moz-animation-timing-function: ease;
  -moz-animation-fill-mode: forwards;
}
@keyframes tansformAnimation {
  from {
    font-size: 90px;
  }
  to {
    font-size: 100px;
  }
}
@-webkit-keyframes tansformAnimation {
  from {
    font-size: 90px;
  }
  to {
    font-size: 100px;
  }
}
@media screen and (max-width: 480px) {
  .small-box {
    text-align: center;
  }
  .small-box .icon {
    display: none;
  }
  .small-box p {
    font-size: 12px;
  }
}
/*
    component: Boxes
-------------------------
*/
.box {
  position: relative;
  background: #ffffff;
  border-top: 2px solid #c1c1c1;
  margin-bottom: 20px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  width: 100%;
  box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
}
.box.box-primary {
  border-top-color: #3c8dbc;
}
.box.box-info {
  border-top-color: #00c0ef;
}
.box.box-danger {
  border-top-color: #f56954;
}
.box.box-warning {
  border-top-color: #f39c12;
}
.box.box-success {
  border-top-color: #00a65a;
}
.box.height-control .box-body {
  max-height: 300px;
  overflow: auto;
}
.box .box-header {
  position: relative;
  -webkit-border-top-left-radius: 3px;
  -webkit-border-top-right-radius: 3px;
  -webkit-border-bottom-right-radius: 0;
  -webkit-border-bottom-left-radius: 0;
  -moz-border-radius-topleft: 3px;
  -moz-border-radius-topright: 3px;
  -moz-border-radius-bottomright: 0;
  -moz-border-radius-bottomleft: 0;
  border-top-left-radius: 3px;
  border-top-right-radius: 3px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
  border-bottom: 0px solid #f4f4f4;
  color: #444;
  padding-bottom: 10px;
}
.box .box-header:before,
.box .box-header:after {
  display: table;
  content: " ";
}
.box .box-header:after {
  clear: both;
}
.box .box-header > .fa,
.box .box-header > .glyphicon,
.box .box-header > .ion,
.box .box-header .box-title {
  display: inline-block;
  padding: 10px 0px 10px 10px;
  margin: 0;
  font-size: 20px;
  font-weight: 400;
  float: left;
  cursor: default;
}
.box .box-header a {
  color: #444;
}
.box .box-header > .box-tools {
  padding: 5px 10px 5px 5px;
}
.box .box-body {
  padding: 10px;
  -webkit-border-top-left-radius: 0;
  -webkit-border-top-right-radius: 0;
  -webkit-border-bottom-right-radius: 3px;
  -webkit-border-bottom-left-radius: 3px;
  -moz-border-radius-topleft: 0;
  -moz-border-radius-topright: 0;
  -moz-border-radius-bottomright: 3px;
  -moz-border-radius-bottomleft: 3px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
  border-bottom-right-radius: 3px;
  border-bottom-left-radius: 3px;
}
.box .box-body > table,
.box .box-body > .table {
  margin-bottom: 0;
}
.box .box-body.chart-responsive {
  width: 100%;
  overflow: hidden;
}
.box .box-body > .chart {
  position: relative;
  overflow: hidden;
  width: 100%;
}
.box .box-body > .chart svg,
.box .box-body > .chart canvas {
  width: 100%!important;
}
.box .box-body .fc {
  margin-top: 5px;
}
.box .box-body .fc-header-title h2 {
  font-size: 15px;
  line-height: 1.6em;
  color: #666;
  margin-left: 10px;
}
.box .box-body .fc-header-right {
  padding-right: 10px;
}
.box .box-body .fc-header-left {
  padding-left: 10px;
}
.box .box-body .fc-widget-header {
  background: #fafafa;
  box-shadow: inset 0px -3px 1px rgba(0, 0, 0, 0.02);
}
.box .box-body .fc-grid {
  width: 100%;
  border: 0;
}
.box .box-body .fc-widget-header:first-of-type,
.box .box-body .fc-widget-content:first-of-type {
  border-left: 0;
  border-right: 0;
}
.box .box-body .fc-widget-header:last-of-type,
.box .box-body .fc-widget-content:last-of-type {
  border-right: 0;
}
.box .box-body .table {
  margin-bottom: 0;
}
.box .box-body .full-width-chart {
  margin: -19px;
}
.box .box-body.no-padding .full-width-chart {
  margin: -9px;
}
.box .box-footer {
  border-top: 1px solid #f4f4f4;
  -webkit-border-top-left-radius: 0;
  -webkit-border-top-right-radius: 0;
  -webkit-border-bottom-right-radius: 3px;
  -webkit-border-bottom-left-radius: 3px;
  -moz-border-radius-topleft: 0;
  -moz-border-radius-topright: 0;
  -moz-border-radius-bottomright: 3px;
  -moz-border-radius-bottomleft: 3px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
  border-bottom-right-radius: 3px;
  border-bottom-left-radius: 3px;
  padding: 10px;
  background-color: #ffffff;
}
.box.box-solid {
  border-top: 0px;
}
.box.box-solid > .box-header {
  padding-bottom: 0px!important;
}
.box.box-solid > .box-header .btn.btn-default {
  background: transparent;
}
.box.box-solid.box-primary > .box-header {
  color: #fff;
  background: #3c8dbc;
  background-color: #3c8dbc;
}
.box.box-solid.box-primary > .box-header a {
  color: #444;
}
.box.box-solid.box-info > .box-header {
  color: #fff;
  background: #00c0ef;
  background-color: #00c0ef;
}
.box.box-solid.box-info > .box-header a {
  color: #444;
}
.box.box-solid.box-danger > .box-header {
  color: #fff;
  background: #f56954;
  background-color: #f56954;
}
.box.box-solid.box-danger > .box-header a {
  color: #444;
}
.box.box-solid.box-warning > .box-header {
  color: #fff;
  background: #f39c12;
  background-color: #f39c12;
}
.box.box-solid.box-warning > .box-header a {
  color: #444;
}
.box.box-solid.box-success > .box-header {
  color: #fff;
  background: #00a65a;
  background-color: #00a65a;
}
.box.box-solid.box-success > .box-header a {
  color: #444;
}
.box.box-solid > .box-header > .box-tools > .btn {
  border: 0;
  box-shadow: none;
}
.box.box-solid.collapsed-box .box-header {
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
}
.box.box-solid[class*='bg'] > .box-header {
  color: #fff;
}
.box .box-group > .box {
  margin-bottom: 5px;
}
.box .knob-label {
  text-align: center;
  color: #333;
  font-weight: 100;
  font-size: 12px;
  margin-bottom: 0.3em;
}
.box .todo-list {
  margin: 0;
  padding: 0px 0px;
  list-style: none;
}
.box .todo-list > li {
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
  padding: 10px;
  background: #f3f4f5;
  margin-bottom: 2px;
  border-left: 2px solid #e6e7e8;
  color: #444;
}
.box .todo-list > li:last-of-type {
  margin-bottom: 0;
}
.box .todo-list > li.danger {
  border-left-color: #f56954;
}
.box .todo-list > li.warning {
  border-left-color: #f39c12;
}
.box .todo-list > li.info {
  border-left-color: #00c0ef;
}
.box .todo-list > li.success {
  border-left-color: #00a65a;
}
.box .todo-list > li.primary {
  border-left-color: #3c8dbc;
}
.box .todo-list > li > input[type='checkbox'] {
  margin: 0 10px 0 5px;
}
.box .todo-list > li .text {
  display: inline-block;
  margin-left: 5px;
  font-weight: 600;
}
.box .todo-list > li .label {
  margin-left: 10px;
  font-size: 9px;
}
.box .todo-list > li .tools {
  display: none;
  float: right;
  color: #f56954;
}
.box .todo-list > li .tools > .fa,
.box .todo-list > li .tools > .glyphicon,
.box .todo-list > li .tools > .ion {
  margin-right: 5px;
  cursor: pointer;
}
.box .todo-list > li:hover .tools {
  display: inline-block;
}
.box .todo-list > li.done {
  color: #999;
}
.box .todo-list > li.done .text {
  text-decoration: line-through;
  font-weight: 500;
}
.box .todo-list > li.done .label {
  background: #eaeaec !important;
}
.box .todo-list .handle {
  display: inline-block;
  cursor: move;
  margin: 0 5px;
}
.box .chat {
  padding: 5px 20px 5px 10px;
}
.box .chat .item {
  margin-bottom: 10px;
}
.box .chat .item:before,
.box .chat .item:after {
  display: table;
  content: " ";
}
.box .chat .item:after {
  clear: both;
}
.box .chat .item > img {
  width: 40px;
  height: 40px;
  border: 2px solid transparent;
  -webkit-border-radius: 50% !important;
  -moz-border-radius: 50% !important;
  border-radius: 50% !important;
}
.box .chat .item > img.online {
  border: 2px solid #00a65a;
}
.box .chat .item > img.offline {
  border: 2px solid #f56954;
}
.box .chat .item > .message {
  margin-left: 55px;
  margin-top: -40px;
}
.box .chat .item > .message > .name {
  display: block;
  font-weight: 600;
}
.box .chat .item > .attachment {
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  background: #f0f0f0;
  margin-left: 65px;
  margin-right: 15px;
  padding: 10px;
}
.box .chat .item > .attachment > h4 {
  margin: 0 0 5px 0;
  font-weight: 600;
  font-size: 14px;
}
.box .chat .item > .attachment > p,
.box .chat .item > .attachment > .filename {
  font-weight: 600;
  font-size: 13px;
  font-style: italic;
  margin: 0;
}
.box .chat .item > .attachment:before,
.box .chat .item > .attachment:after {
  display: table;
  content: " ";
}
.box .chat .item > .attachment:after {
  clear: both;
}
.box > .overlay,
.box > .loading-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.box > .overlay {
  z-index: 1010;
  background: rgba(255, 255, 255, 0.7);
}
.box > .overlay.dark {
  background: rgba(0, 0, 0, 0.5);
}
.box > .loading-img {
  z-index: 1020;
  background: transparent url('../img/ajax-loader1.gif') 50% 50% no-repeat;
}
/*
Component: timeline
--------------------
*/
.timeline {
  margin: 0 0 30px 0;
  padding: 0;
  list-style: none;
}
.timeline:before {
  content: '';
  position: absolute;
  top: 0px;
  bottom: 0;
  width: 5px;
  background: #ddd;
  left: 45px;
  border: 1px solid #eee;
  margin: 0;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
}
.timeline > li {
  position: relative;
  margin-right: 10px;
  margin-bottom: 15px;
}
.timeline > li:before,
.timeline > li:after {
  display: table;
  content: " ";
}
.timeline > li:after {
  clear: both;
}
.timeline > li > .timeline-item {
  margin-top: 10px;
  border: 0px solid #dfdfdf;
  background: #fff;
  color: #555;
  margin-left: 60px;
  margin-right: 15px;
  padding: 5px;
  position: relative;
  box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
}
.timeline > li > .timeline-item > .time {
  color: #999;
  float: right;
  margin: 2px 0 0 0;
}
.timeline > li > .timeline-item > .timeline-header {
  margin: 0;
  color: #555;
  border-bottom: 1px solid #f4f4f4;
  padding: 5px;
  font-size: 16px;
  line-height: 1.1;
}
.timeline > li > .timeline-item > .timeline-header > a {
  font-weight: 600;
}
.timeline > li > .timeline-item > .timeline-body,
.timeline > li > .timeline-item > .timeline-footer {
  padding: 10px;
}
.timeline > li.time-label > span {
  font-weight: 600;
  padding: 5px;
  display: inline-block;
  background-color: #fff;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.5);
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
}
.timeline > li > .fa,
.timeline > li > .glyphicon,
.timeline > li > .ion {
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
  width: 30px;
  height: 30px;
  font-size: 15px;
  line-height: 30px;
  position: absolute;
  color: #666;
  background: #eee;
  border-radius: 50%;
  text-align: center;
  left: 18px;
  top: 0;
}
/*
    Component: Buttons
-------------------------
*/
.btn {
  font-weight: 500;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  border: 1px solid transparent;
  -webkit-box-shadow: inset 0px -2px 0px 0px rgba(0, 0, 0, 0.09);
  -moz-box-shadow: inset 0px -2px 0px 0px rgba(0, 0, 0, 0.09);
  box-shadow: inset 0px -1px 0px 0px rgba(0, 0, 0, 0.09);
}
.btn.btn-default {
  background-color: #fafafa;
  color: #666;
  border-color: #ddd;
  border-bottom-color: #ddd;
}
.btn.btn-default:hover,
.btn.btn-default:active,
.btn.btn-default.hover {
  background-color: #f4f4f4!important;
}
.btn.btn-default.btn-flat {
  border-bottom-color: #d9dadc;
}
.btn.btn-primary {
  background-color: #3c8dbc;
  border-color: #367fa9;
}
.btn.btn-primary:hover,
.btn.btn-primary:active,
.btn.btn-primary.hover {
  background-color: #367fa9;
}
.btn.btn-success {	
  background-color: #00a65a;
  border-color: #008d4c;
}
.btn.btn-success:hover,
.btn.btn-success:active,
.btn.btn-success.hover {
  background-color: #008d4c;
}
.btn.btn-info {
  background-color: #00c0ef;
  border-color: #00acd6;
}
.btn.btn-info:hover,
.btn.btn-info:active,
.btn.btn-info.hover {
  background-color: #00acd6;
}
.btn.btn-danger {
  background-color: #f56954;
  border-color: #f4543c;
}
.btn.btn-danger:hover,
.btn.btn-danger:active,
.btn.btn-danger.hover {
  background-color: #f4543c;
}
.btn.btn-warning {
  background-color: #f39c12;
  border-color: #e08e0b;
}
.btn.btn-warning:hover,
.btn.btn-warning:active,
.btn.btn-warning.hover {
  background-color: #e08e0b;
}
.btn.btn-sm {
  font-size: 12px;
}
.btn.btn-lg {
  padding: 10px 16px;
}
.btn.btn-block {
  font-size: 15px;
  padding: 10px;
}
.btn.btn-block.btn-sm {
  font-size: 13px;
  padding: 7px;
}
.btn.btn-flat {
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
  border-width: 1px;
}
.btn:active {
  -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
  -moz-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
  box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}
.btn:focus {
  outline: none;
}
.btn.btn-file {
  position: relative;
  width: 120px;
  height: 35px;
  overflow: hidden;
}
.btn.btn-file > input[type='file'] {
  display: block !important;
  width: 100% !important;
  height: 35px !important;
  opacity: 0 !important;
  position: absolute;
  top: -10px;
  cursor: pointer;
}
.btn.btn-app {
  position: relative;
  padding: 15px 5px;
  margin: 0 0 10px 10px;
  min-width: 80px;
  height: 60px;
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
  text-align: center;
  color: #666;
  border: 1px solid #ddd;
  background-color: #fafafa;
  font-size: 12px;
}
.btn.btn-app > .fa,
.btn.btn-app > .glyphicon,
.btn.btn-app > .ion {
  font-size: 20px;
  display: block;
}
.btn.btn-app:hover {
  background: #f4f4f4;
  color: #444;
  border-color: #aaa;
}
.btn.btn-app:active,
.btn.btn-app:focus {
  -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
  -moz-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
  box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}
.btn.btn-app > .badge {
  position: absolute;
  top: -3px;
  right: -10px;
  font-size: 10px;
  font-weight: 400;
}
.btn.btn-social {
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
  opacity: 0.9;
  padding: 0;
}
.btn.btn-social > .fa {
  padding: 10px 0;
  width: 40px;
}
.btn.btn-social > .fa + span {
  border-left: 1px solid rgba(255, 255, 255, 0.3);
}
.btn.btn-social span {
  padding: 10px;
}
.btn.btn-social:hover {
  opacity: 1;
}
.btn.btn-circle {
  width: 30px;
  height: 30px;
  line-height: 30px;
  padding: 0;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
}
/* 
    Component: callout
------------------------
*/
.callout {
  margin: 0 0 20px 0;
  padding: 15px 30px 15px 15px;
  border-left: 5px solid #eee;
}
.callout h4 {
  margin-top: 0;
}
.callout p:last-child {
  margin-bottom: 0;
}
.callout code,
.callout .highlight {
  background-color: #fff;
}
.callout.callout-danger {
  background-color: #fcf2f2;
  border-color: #dFb5b4;
}
.callout.callout-warning {
  background-color: #fefbed;
  border-color: #f1e7bc;
}
.callout.callout-info {
  background-color: #f0f7fd;
  border-color: #d0e3f0;
}
.callout.callout-danger h4 {
  color: #B94A48;
}
.callout.callout-warning h4 {
  color: #C09853;
}
.callout.callout-info h4 {
  color: #3A87AD;
}
/* 
    Component: alert
------------------------
*/
.alert {
  padding-left: 30px;
  margin-left: 15px;
  position: relative;
}
.alert > .fa,
.alert > .glyphicon {
  position: absolute;
  left: -15px;
  top: -15px;
  width: 35px;
  height: 35px;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  line-height: 35px;
  text-align: center;
  background: inherit;
  border: inherit;
}
/*
    Component: Navs
*/
/* NAV PILLS */
.nav.nav-pills > li > a {
  border-top: 3px solid transparent;
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
  color: #444;
}
.nav.nav-pills > li > a > .fa,
.nav.nav-pills > li > a > .glyphicon,
.nav.nav-pills > li > a > .ion {
  margin-right: 5px;
}
.nav.nav-pills > li.active > a,
.nav.nav-pills > li.active > a:hover {
  background-color: #f6f6f6;
  border-top-color: #3c8dbc;
  color: #444;
}
.nav.nav-pills > li.active > a {
  font-weight: 600;
}
.nav.nav-pills > li > a:hover {
  background-color: #f6f6f6;
}
.nav.nav-pills.nav-stacked > li > a {
  border-top: 0;
  border-left: 3px solid transparent;
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
  color: #444;
}
.nav.nav-pills.nav-stacked > li.active > a,
.nav.nav-pills.nav-stacked > li.active > a:hover {
  background-color: #f6f6f6;
  border-left-color: #3c8dbc;
  color: #444;
}
.nav.nav-pills.nav-stacked > li.header {
  border-bottom: 1px solid #ddd;
  color: #777;
  margin-bottom: 10px;
  padding: 5px 10px;
  text-transform: uppercase;
}
/* NAV TABS */
.nav-tabs-custom {
  margin-bottom: 20px;
  background: #fff;
  box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
}
.nav-tabs-custom > .nav-tabs {
  margin: 0;
  border-bottom-color: #f4f4f4;
}
.nav-tabs-custom > .nav-tabs > li {
  border-top: 3px solid transparent;
  margin-bottom: -2px;
  margin-right: 5px;
}
.nav-tabs-custom > .nav-tabs > li > a {
  -webkit-border-radius: 0 !important;
  -moz-border-radius: 0 !important;
  border-radius: 0 !important;
}
.nav-tabs-custom > .nav-tabs > li > a,
.nav-tabs-custom > .nav-tabs > li > a:hover {
  background: transparent;
  margin: 0;
}
.nav-tabs-custom > .nav-tabs > li:not(.active) > a:hover,
.nav-tabs-custom > .nav-tabs > li:not(.active) > a:focus,
.nav-tabs-custom > .nav-tabs > li:not(.active) > a:active {
  border-color: transparent;
}
.nav-tabs-custom > .nav-tabs > li.active {
  border-top-color: #3c8dbc;
}
.nav-tabs-custom > .nav-tabs > li.active > a,
.nav-tabs-custom > .nav-tabs > li.active:hover > a {
  background-color: #fff;
}
.nav-tabs-custom > .nav-tabs > li.active > a {
  border-top: 0;
  border-left-color: #f4f4f4;
  border-right-color: #f4f4f4;
}
.nav-tabs-custom > .nav-tabs > li:first-of-type {
  margin-left: 0px;
}
.nav-tabs-custom > .nav-tabs > li:first-of-type.active > a {
  border-left-width: 0;
}
.nav-tabs-custom > .nav-tabs.pull-right {
  float: none!important;
}
.nav-tabs-custom > .nav-tabs.pull-right > li {
  float: right;
}
.nav-tabs-custom > .nav-tabs.pull-right > li:first-of-type {
  margin-right: 0px;
}
.nav-tabs-custom > .nav-tabs.pull-right > li:first-of-type.active > a {
  border-left-width: 1px;
  border-right-width: 0px;
}
.nav-tabs-custom > .nav-tabs > li.header {
  font-weight: 400;
  line-height: 35px;
  padding: 0 10px;
  font-size: 20px;
  color: #444;
  cursor: default;
}
.nav-tabs-custom > .nav-tabs > li.header > .fa,
.nav-tabs-custom > .nav-tabs > li.header > .glyphicon,
.nav-tabs-custom > .nav-tabs > li.header > .ion {
  margin-right: 10px;
}
.nav-tabs-custom > .tab-content {
  background: #fff;
  padding: 10px;
}
/* PAGINATION */
.pagination > li > a {
  background: #fafafa;
  color: #666;
  -webkit-box-shadow: inset 0px -2px 0px 0px rgba(0, 0, 0, 0.09);
  -moz-box-shadow: inset 0px -2px 0px 0px rgba(0, 0, 0, 0.09);
  box-shadow: inset 0px -1px 0px 0px rgba(0, 0, 0, 0.09);
}
.pagination > li:first-of-type a,
.pagination > li:last-of-type a {
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
}
/*
    Component: Mailbox
*/
.mailbox .table-mailbox {
  border-left: 1px solid #ddd;
  border-right: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
}
.mailbox .table-mailbox tr.unread > td {
  background-color: rgba(0, 0, 0, 0.05);
  color: #000;
  font-weight: 600;
}
.mailbox .table-mailbox tr > td > .fa.fa-star,
.mailbox .table-mailbox tr > td > .fa.fa-star-o,
.mailbox .table-mailbox tr > td > .glyphicon.glyphicon-star,
.mailbox .table-mailbox tr > td > .glyphicon.glyphicon-star-empty {
  color: #f39c12;
  cursor: pointer;
}
.mailbox .table-mailbox tr > td.small-col {
  width: 30px;
}
.mailbox .table-mailbox tr > td.name {
  width: 150px;
  font-weight: 600;
}
.mailbox .table-mailbox tr > td.time {
  text-align: right;
  width: 100px;
}
.mailbox .table-mailbox tr > td {
  white-space: nowrap;
}
.mailbox .table-mailbox tr > td > a {
  color: #444;
}
@media screen and (max-width: 767px) {
  .mailbox .nav-stacked > li:not(.header) {
    float: left;
    width: 50%;
  }
  .mailbox .nav-stacked > li:not(.header).header {
    border: 0!important;
  }
  .mailbox .search-form {
    margin-top: 10px;
  }
}
/*
    Page: locked screen
*/
/* ADD THIS CLASS TO THE <HTML> TAG */
.lockscreen {
  background: url(../img/blur-background09.jpg) repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
/* Remove the background from the body element */
.lockscreen > body {
  background: transparent;
}
/* We will put the dynamically generated digital clock here */
.lockscreen .headline {
  color: #fff;
  text-shadow: 1px 3px 5px rgba(0, 0, 0, 0.5);
  font-weight: 300;
  -webkit-font-smoothing: antialiased !important;
  opacity: 0.8;
  margin: 10px 0 30px 0;
  font-size: 90px;
}
@media screen and (max-width: 480px) {
  .lockscreen .headline {
    font-size: 60px;
    margin-bottom: 40px;
  }
}
/* User name [optional] */
.lockscreen .lockscreen-name {
  text-align: center;
  font-weight: 600;
  font-size: 16px;
}
/* Will contain the image and the sign in form */
.lockscreen-item {
  padding: 0;
  background: #fff;
  position: relative;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  margin: 10px auto;
  width: 290px;
}
.lockscreen-item:before,
.lockscreen-item:after {
  display: table;
  content: " ";
}
.lockscreen-item:after {
  clear: both;
}
/* User image */
.lockscreen-item > .lockscreen-image {
  position: absolute;
  left: -10px;
  top: -30px;
  background: #fff;
  padding: 10px;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  z-index: 10;
}
.lockscreen-item > .lockscreen-image > img {
  width: 70px;
  height: 70px;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
}
/* Contains the password input and the login button */
.lockscreen-item > .lockscreen-credentials {
  margin-left: 80px;
}
.lockscreen-item > .lockscreen-credentials input {
  border: 0 !important;
}
.lockscreen-item > .lockscreen-credentials .btn {
  background-color: #fff;
  border: 0;
}
/* Extra to give the user an option to navigate the website [optional]*/
.lockscreen-link {
  margin-top: 30px;
  text-align: center;
}
/* 
    Page: register and login
*/
.form-box {
  width: 360px;
  margin: 90px auto 0 auto;
}
.form-box .header {
  -webkit-border-top-left-radius: 4px;
  -webkit-border-top-right-radius: 4px;
  -webkit-border-bottom-right-radius: 0;
  -webkit-border-bottom-left-radius: 0;
  -moz-border-radius-topleft: 4px;
  -moz-border-radius-topright: 4px;
  -moz-border-radius-bottomright: 0;
  -moz-border-radius-bottomleft: 0;
  border-top-left-radius: 4px;
  border-top-right-radius: 4px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
  background: #3d9970;
  box-shadow: inset 0px -3px 0px rgba(0, 0, 0, 0.2);
  padding: 20px 10px;
  text-align: center;
  font-size: 26px;
  font-weight: 300;
  color: #fff;
}
.form-box .body,
.form-box .footer {
  padding: 10px 20px;
  background: #fff;
  color: #444;
}
.form-box .body > .form-group,
.form-box .footer > .form-group {
  margin-top: 20px;
}
.form-box .body > .form-group > input,
.form-box .footer > .form-group > input {
  border: #fff;
}
.form-box .body > .btn,
.form-box .footer > .btn {
  margin-bottom: 10px;
}
.form-box .footer {
  -webkit-border-top-left-radius: 0;
  -webkit-border-top-right-radius: 0;
  -webkit-border-bottom-right-radius: 4px;
  -webkit-border-bottom-left-radius: 4px;
  -moz-border-radius-topleft: 0;
  -moz-border-radius-topright: 0;
  -moz-border-radius-bottomright: 4px;
  -moz-border-radius-bottomleft: 4px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
  border-bottom-right-radius: 4px;
  border-bottom-left-radius: 4px;
}
@media (max-width: 767px) {
  .form-box {
    width: 90%;
  }
}
/* 
    Page: 404 and 500 error pages
------------------------------------
*/
.error-page {
  width: 600px;
  margin: 20px auto 0 auto;
}
@media screen and (max-width: 767px) {
  .error-page {
    width: 100%;
  }
}
.error-page > .headline {
  float: left;
  font-size: 100px;
  font-weight: 300;
}
@media screen and (max-width: 767px) {
  .error-page > .headline {
    float: none;
    text-align: center;
  }
}
.error-page > .error-content {
  margin-left: 190px;
  display: block;
}
@media screen and (max-width: 767px) {
  .error-page > .error-content {
    margin-left: 0;
  }
}
.error-page > .error-content > h3 {
  font-weight: 300;
  font-size: 25px;
}
@media screen and (max-width: 767px) {
  .error-page > .error-content > h3 {
    text-align: center;
  }
}
.error-page:before,
.error-page:after {
  display: table;
  content: " ";
}
.error-page:after {
  clear: both;
}
/* 
    Page: Invoice
*/
.invoice {
  position: relative;
  width: 90%;
  margin: 10px auto;
  background: #fff;
  border: 1px solid #f4f4f4;
}
.invoice-title {
  margin-top: 0;
}
/* Enhancement for printing */
@media print {
  .invoice {
    width: 100%;
    border: 0;
    margin: 0;
    padding: 0;
  }
  .invoice-col {
    float: left;
    width: 33.3333333%;
  }
  .table-responsive {
    overflow: auto;
  }
  .table-responsive > .table tr th,
  .table-responsive > .table tr td {
    white-space: normal!important;
  }
}
/* 
    Skins
    -----
*/
/* 
    skin-blue 
    ---------
*/
/* skin-blue navbar */
.skin-blue .navbar {
  background-color: #<?= $base_colour->bg['0'] ?>;
}
a {
  color: #<?= $base_colour->bg['0'] ?>;
}
a:hover,
a:active,
a:focus {
  outline: none;
  text-decoration: none;
  color: #<?= $base_colour->bg['+2'] ?>;
}
.nav-tabs-custom > .nav-tabs > li.active {
  border-top-color: #<?= $base_colour->bg['0'] ?>;
}
.bg-skin-blue {
  background-color: #<?= $base_colour->bg['0'] ?>;
}
.fg-skin-blue {
  color: #<?= $base_colour->fg['0'] ?>;
}
.btn.btn-primary {
  background-color: #<?= $base_colour->bg['-1'] ?>;
  border-color: #<?= $base_colour->bg['-3'] ?>;
}
.btn.btn-primary:hover,
.btn.btn-primary:active,
.btn.btn-primary.hover {
  background-color: #<?= $base_colour->bg['-3'] ?>;
}
.box.box-solid.box-primary > .box-header {
  color: #<?= $base_colour->fg['0'] ?>;
  background: #<?= $base_colour->bg['0'] ?>;
  background-color: #<?= $base_colour->bg['0'] ?>;
}
.box.box-solid[class*='bg'] > .box-header {
  color: #<?= $base_colour->fg['0'] ?>;
}
.skin-blue .navbar .nav a {
  color: #<?= $base_colour->fg['0'] ?>;
}
.skin-blue .navbar .nav > li > a:hover,
.skin-blue .navbar .nav > li > a:active,
.skin-blue .navbar .nav > li > a:focus,
.skin-blue .navbar .nav .open > a,
.skin-blue .navbar .nav .open > a:hover,
.skin-blue .navbar .nav .open > a:focus {
  background: #<?= $base_colour->bg['-2'] ?>;
  color: #<?= $base_colour->fg['-2'] ?>;
}
.skin-blue .navbar .navbar-right > .nav {
  margin-right: 10px;
}
.skin-blue .navbar .sidebar-toggle .icon-bar {
  background: #<?= $base_colour->fg['0'] ?>;
}
/* skin-blue logo */
.skin-blue .logo {
  background-color: #<?= $base_colour->bg['-1'] ?>;
  color: #<?= $base_colour->fg['-1'] ?>;
}
.skin-blue .logo > a {
  color: #<?= $base_colour->fg['-2'] ?>;
}
.skin-blue .logo:hover {
  background: #<?= $base_colour->bg['-2'] ?>;
}
/* Skin-blue user panel */
.skin-blue .user-panel > .image > img {
  border: 1px solid #dfdfdf;
}
.skin-blue .user-panel > .info,
.skin-blue .user-panel > .info > a {
  color: #555555;
}
/* skin-blue sidebar */
.skin-blue .sidebar {
  border-bottom: 1px solid #fff;
}
.skin-blue .sidebar > .sidebar-menu > li {
  border-top: 1px solid #fff;
  border-bottom: 1px solid #dbdbdb;
}
.skin-blue .sidebar > .sidebar-menu > li:first-of-type {
  border-top: 1px solid #dbdbdb;
}
.skin-blue .sidebar > .sidebar-menu > li:first-of-type > a {
  border-top: 1px solid #fff;
}
.skin-blue .sidebar > .sidebar-menu > li > a {
  margin-right: 1px;
}
.skin-blue .sidebar > .sidebar-menu > li > a:hover,
.skin-blue .sidebar > .sidebar-menu > li.active > a {
  color: #222;
  background: #f9f9f9;
}
.skin-blue .sidebar > .sidebar-menu > li > .treeview-menu {
  margin: 0 1px;
  background: #f9f9f9;
}
.skin-blue .left-side {
  background: #f4f4f4;
  -webkit-box-shadow: inset -3px 0px 8px -4px rgba(0, 0, 0, 0.1);
  -moz-box-shadow: inset -3px 0px 8px -4px rgba(0, 0, 0, 0.1);
  box-shadow: inset -3px 0px 8px -4px rgba(0, 0, 0, 0.07);
}
.skin-blue .sidebar a {
  color: #555555;
}
.skin-blue .sidebar a:hover {
  text-decoration: none;
}
.skin-blue .treeview-menu > li > a {
  color: #777;
}
.skin-blue .treeview-menu > li.active > a,
.skin-blue .treeview-menu > li > a:hover {
  color: #111;
}
.skin-blue .sidebar-form {
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
  border: 1px solid #dbdbdb;
  margin: 10px 10px;
}
.skin-blue .sidebar-form input[type="text"],
.skin-blue .sidebar-form .btn {
  box-shadow: none;
  background-color: #fafafa;
  border: 1px solid #fafafa;
  height: 35px;
}
.skin-blue .sidebar-form input[type="text"] {
  color: #666;
  -webkit-border-top-left-radius: 2px !important;
  -webkit-border-top-right-radius: 0 !important;
  -webkit-border-bottom-right-radius: 0 !important;
  -webkit-border-bottom-left-radius: 2px !important;
  -moz-border-radius-topleft: 2px !important;
  -moz-border-radius-topright: 0 !important;
  -moz-border-radius-bottomright: 0 !important;
  -moz-border-radius-bottomleft: 2px !important;
  border-top-left-radius: 2px !important;
  border-top-right-radius: 0 !important;
  border-bottom-right-radius: 0 !important;
  border-bottom-left-radius: 2px !important;
}
.skin-blue .sidebar-form input[type="text"]:focus,
.skin-blue .sidebar-form input[type="text"]:focus + .input-group-btn .btn {
  background-color: #fff;
  color: #666;
}
.skin-blue .sidebar-form input[type="text"]:focus + .input-group-btn .btn {
  border-left-color: #fff;
}
.skin-blue .sidebar-form .btn {
  color: #999;
  -webkit-border-top-left-radius: 0 !important;
  -webkit-border-top-right-radius: 2px !important;
  -webkit-border-bottom-right-radius: 2px !important;
  -webkit-border-bottom-left-radius: 0 !important;
  -moz-border-radius-topleft: 0 !important;
  -moz-border-radius-topright: 2px !important;
  -moz-border-radius-bottomright: 2px !important;
  -moz-border-radius-bottomleft: 0 !important;
  border-top-left-radius: 0 !important;
  border-top-right-radius: 2px !important;
  border-bottom-right-radius: 2px !important;
  border-bottom-left-radius: 0 !important;
}
/*!
 * iCheck v1.0.1, http://git.io/arlzeA
 * =================================
 * Powerful jQuery and Zepto plugin for checkboxes and radio buttons customization
 *
 * (c) 2013 Damir Sultanov, http://fronteed.com
 * MIT Licensed
 */
/* iCheck plugin Minimal skin, black
----------------------------------- */
.icheckbox_minimal,
.iradio_minimal {
  display: inline-block;
  *display: inline;
  vertical-align: middle;
  margin: 0;
  padding: 0;
  width: 18px;
  height: 18px;
  background: rgba(255, 255, 255, 0.7) url(iCheck/minimal/minimal.png) no-repeat;
  border: none;
  cursor: pointer;
}
.icheckbox_minimal {
  background-position: 0 0;
}
.icheckbox_minimal.hover {
  background-position: -20px 0;
}
.icheckbox_minimal.checked {
  background-position: -40px 0;
}
.icheckbox_minimal.disabled {
  background-position: -60px 0;
  cursor: default;
}
.icheckbox_minimal.checked.disabled {
  background-position: -80px 0;
}
.iradio_minimal {
  background-position: -100px 0;
}
.iradio_minimal.hover {
  background-position: -120px 0;
}
.iradio_minimal.checked {
  background-position: -140px 0;
}
.iradio_minimal.disabled {
  background-position: -160px 0;
  cursor: default;
}
.iradio_minimal.checked.disabled {
  background-position: -180px 0;
}
/* Retina support */
@media only screen and (-webkit-min-device-pixel-ratio: 1.5), only screen and (-moz-min-device-pixel-ratio: 1.5), only screen and (-o-min-device-pixel-ratio: 3/2), only screen and (min-device-pixel-ratio: 1.5) {
  .icheckbox_minimal,
  .iradio_minimal {
    background-image: url('iCheck/minimal/minimal@2x.png');
    -webkit-background-size: 200px 20px;
    background-size: 200px 20px;
  }
}

.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

input[readonly] {
  background-color: white !important;
  cursor: text !important;
}
