import '@coreui/coreui'

// datatables
import "datatables.net-bs4";
require("datatables.net-buttons-bs4");
import "datatables.net-responsive-bs4";
import "datatables.net-buttons/js/buttons.colVis.min";
import "datatables.net-buttons/js/dataTables.buttons.min";
import "datatables.net-buttons/js/buttons.flash.min";
import "datatables.net-buttons/js/buttons.html5.min";
import "datatables.net-buttons/js/buttons.print.min";
import pdfMake from "pdfmake/build/pdfmake";
import pdfFonts from "pdfmake/build/vfs_fonts";
import jsZip from "jszip";
window.JSZip = jsZip;
pdfMake.vfs = pdfFonts.pdfMake.vfs;