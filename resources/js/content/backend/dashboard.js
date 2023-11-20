/*=========================================================================================
    File Name: dashboard.js
    Description: dashboard Page
==========================================================================================*/
$(function () {
	var $page = $('#dashboard-page'),
		$table = {};

	var page = {
        dtTable: {},
        init() {
            Morris.Area({
                element: 'chart1',
                data: [
                  { y: '2006', a: 100, b: 90 },
                  { y: '2007', a: 75,  b: 65 },
                  { y: '2008', a: 50,  b: 40 },
                  { y: '2009', a: 75,  b: 65 },
                  { y: '2010', a: 50,  b: 40 },
                  { y: '2011', a: 75,  b: 65 },
                  { y: '2012', a: 100, b: 90 }
                ],
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Series A', 'Series B']
            });            
            Morris.Bar({
                element: 'chart2',
                data: [
                  { y: '2006', a: 100, b: 90 },
                  { y: '2007', a: 75,  b: 65 },
                  { y: '2008', a: 50,  b: 40 },
                  { y: '2009', a: 75,  b: 65 },
                  { y: '2010', a: 50,  b: 40 },
                  { y: '2011', a: 75,  b: 65 },
                  { y: '2012', a: 100, b: 90 }
                ],
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Series A', 'Series B']
            });            
        }
	};

	if ($page.length) {
		page.init();
	} 
});