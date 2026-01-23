<?php

function wp_show_stats_pages() {

    global $wpdb;
    
    // get page data 
    $totalPages = wp_count_posts('page');
    $totalPagesArray = (array)$totalPages;
    unset($totalPagesArray['auto-draft']);
    unset($totalPagesArray['inherit']);
    $countPages = array_sum($totalPagesArray);
    
    ?>

        <?php if($countPages > 0){ 
            
            $data_str = "";
            $data_obj = "";
            //if(isset($usersCount['avail_roles']) && sizeof($usersCount['avail_roles']) > 0){
                foreach ($totalPagesArray as $key => $value) {
                    $data_str .= "'".ucfirst($key)."', ";

                    if($value == '0'){ $value = "'-'";}
                     $data_obj .= "{value: ".$value.",  name:'".ucfirst($key)."'}, ";
                }

                 $data_str = substr($data_str,0,-2);
                 $data_str = "[".$data_str."]";

                 $data_obj = substr($data_obj,0,-2);
                 $data_obj = "[".$data_obj."]";

           // }
        ?>

<?php 
    $getcolor = mtrl_dashboard_widget_color();
                // print_r($getcolor);
?>

<?php 
/*$getcolor = array();
$getcolor[0] = "#E57373";
$getcolor[1] = "#FFD54F";
$getcolor[2] = "#F06292";
$getcolor[3] = "#FFB74D";
$getcolor[4] = "#FF8A65";
$getcolor[5] = "#FFF176";*/
?>
            <div class="chartBox"><?php // echo "<pre>"; print_r($totalPagesArray); echo "Total Pages: ".$countPages; echo "</pre>"; ?>
                <div id="totalPages_wiseChart" style='height:400px;'></div>
            </div>

            <script type="text/javascript">
              // Initialize after dom ready
            //   console.log("hi");
              var myChart7 = echarts.init(document.getElementById('totalPages_wiseChart')); 
                    
              var option = {
                color: ['<?php echo $getcolor[0]; ?>','<?php echo $getcolor[1]; ?>','<?php echo $getcolor[2]; ?>','<?php echo $getcolor[3]; ?>','<?php echo $getcolor[4]; ?>','<?php echo $getcolor[5]; ?>','<?php echo $getcolor[6]; ?>','<?php echo $getcolor[7]; ?>','<?php echo $getcolor[8]; ?>','<?php echo $getcolor[9]; ?>','<?php echo $getcolor[10]; ?>','<?php echo $getcolor[11]; ?>','<?php echo $getcolor[12]; ?>','<?php echo $getcolor[13]; ?>','<?php echo $getcolor[14]; ?>','<?php echo $getcolor[15]; ?>','<?php echo $getcolor[16]; ?>','<?php echo $getcolor[17]; ?>','<?php echo $getcolor[18]; ?>','<?php echo $getcolor[19]; ?>'],

                    tooltip : {
                        trigger: 'item',
                        formatter: "{a} <br/>{b} : {c} ({d}%)"
                    },
                            legend: {
                                x: 'left',
                                orient:'vertical',
                                padding: 0,
                                data:<?php echo $data_str; ?>
                            },
                    toolbox: {
					  orient: 'vertical',
                        show : true,
                        color : ['#bdbdbd','#bdbdbd','#bdbdbd','#bdbdbd'],
                    itemSize: 13,
                    itemGap: 10,
                        feature : {
                            mark : {show: false},
                                    dataView : {show: false, readOnly: true},
                                    magicType : {
                                        show: true, 
										title : {
											  pie : '<?php _e('Pie','mtrl_framework');?>',
											  funnel : '<?php _e('Funnel','mtrl_framework');?>'
										  },
                                        type: ['pie', 'funnel'],
                                        option: {
                                            funnel: {
                                                x: '25%',
                                                width: '50%',
                                                funnelAlign: 'center',
                                                max: 1700
                                            },
                                            pie: {
                                                roseType : 'none',
                                            }
                                        }
                                    },
                                    restore : {show: false},
                                    saveAsImage : {show: true,title:'<?php _e('Save as Image','mtrl_framework');?>'}
                        }
                    },
                    calculable : true,
                    series : [
                        {
                            name:'<?php _e('Page Count','mtrl_framework');?>',
                            type:'pie',
                            radius : [20, '44%'],
                            roseType : 'radius',
                            center: ['50%', '35%'],
                            width: '50%',       // for funnel
                            max: 40,            // for funnel
                            itemStyle : {
                                   normal : { label : { show : true }, labelLine : { show : true } },
                                   emphasis : { label : { show : false }, labelLine : {show : false} }
                             },
                            data:<?php echo $data_obj; ?>
                        }
                    ]};

                    // Load data into the ECharts instance 
                    myChart7.setOption(option); 
                    jQuery(window).on('resize', function(){
                      myChart7.resize();
                    });
                    
                </script>

        <?php } ?>
        





<?php } ?>