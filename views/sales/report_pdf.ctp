<?php 
App::import('Vendor','report');
//$data=array();

/* $data =array(
		'Total_Sales' => 240,
		'Total_Food' => 210,
		'Total_Shelf' => 30,
		'Total_Details' => array(
				'Food' => array
					(
						'002000004' => array
							(
								'Qty'=> 4,
								'Barcode' => 002000004,
								'Desc' => 'Menudo',
								'Amount' => 50.00,
								'Total'=> 200
							),

						'002000002' => array
							(
								'Qty'=> 1,
								'Barcode' => 002000002,
								'Desc' => 'Asdfg Qwerty',
								'Amount' => 10.00,
								'Total' => 10
							)

					),

				'Shelf' => array(
						'013000005' => array(
								'Qty' => 2,
								'Barcode' => 013000005,
								'Desc' => 'Mamon Roll',
								'Amount' => 15.00,
								'Total' => 30,
							)

					)

			)
		); */
$container = array();
foreach($data['Total_Details']['Food'] as $food){
	$f =array('flag'=>'F','content'=>$food);

	array_push($container,$f);
}
foreach($data['Total_Details']['Shelf'] as $shelf){
	$s =array('flag'=>'S','content'=>$shelf);
	array_push($container,$s);
}
	
		
		
		
//pr($container);
//exit;	
		
$date=$data['Date'];
$form=new orForm($data);
$form->hdr($date);
$form->details($container);
//$form->displayReport($container,0);


$form->output();
?>