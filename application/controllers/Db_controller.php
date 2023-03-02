<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
class Db_controller extends MY_Controller
{
	public $page  = 'Dashboard';
	public function __construct()
	{
		parent::__construct();
		if (!$this->is_logged_in()) {
			redirect('/login');
		}
	}
	public function createTable()
	{
		$this->load->dbforge();
		$fields = [
			'cat_id' => [
				'type' => 'INT',
				'constraint' => '11',
				'auto_increment' => TRUE
			],
		
            'cat_name' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'default' => NULL,
			],
          
			'cat_status' => [
				'type' => 'INT',
				'constraint' => '11',
			],
		];
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('cat_id', TRUE);
		//edit here table name
	//$query = $this->dbforge->create_table('tbl_category');
		if ($query) {
			echo "Success";
		} else {
			echo "failed";
		}
	}
	public function modifyTable()
	{
		$this->load->dbforge();
		$fields = [
			'scheme_status' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],	
		];
	 	//$query = $this->dbforge->modify_column('tbl_scheme', $fields);
		if ($query) {
			echo "Success";
		} else {
			echo "failed";
		} 
	}
	public function alterTable()
	{
		$this->load->dbforge();
		$fields = [
			
				'punit_batch_no' => [
					'type' => 'VARCHAR',
					'constraint' => '80',
				],

				'batch_no' => [
					'type' => 'INT',
				],

				'punit_product_cost' => [
					'type' => 'FLOAT',
				],

				'punit_purchase_cost' => [
					'type' => 'FLOAT',
				],
				
		];
	//	$query = $this->dbforge->add_column('tbl_production_unit',$fields);  //uncomment this line
		if ($query) {
			echo "Success";
		} else {
			echo "failed";
		} 
	}
	public function truncateTable()
	{
		$this->load->dbforge();
		//$query=$this->db->truncate('tbl_purchase');
		if ($query) {
			echo "Success";
		} else {
			echo "failed";
		}
	}
	public function dropTable()
	{
		$this->load->dbforge();
		//$query = $this->dbforge->drop_table('ntbl_stock_incoming');
		if ($query) {
			echo "Success";
		} else {
			echo "failed";
		}
	}
	public function mydb_backup()
	{
		$this->load->dbutil();
		$prefs = array(
			'format'      => 'zip',
			'filename'    => 'my_db_backup.sql'
		);
		$backup = &$this->dbutil->backup($prefs);
		$db_name = 'backup-on-' . date("Y-m-d-H-i-s") . '.zip';
		/* $save = 'pathtobkfolder/'.$db_name;
$this->load->helper('file');
write_file($save, $backup);  */
		$this->load->helper('download');
		force_download($db_name, $backup);
	}
	public function run_sql(){
		/* $sql="CREATE TABLE IF NOT EXISTS `tbl_branch_receipt` (
			`receipt_id` int(11) NOT NULL AUTO_INCREMENT,
			`branch_id_fk` int(11) NOT NULL,
			`receipt_id_fk` varchar(11) NOT NULL,
			`finyear_id_fk` int(11) NOT NULL,
			`receipt_number` int(11) NOT NULL,
			`receipt_amount` varchar(100) NOT NULL,
			`rept_date` date NOT NULL,
			`paid_to` varchar(200) NOT NULL,
			`narration` varchar(250) NOT NULL,
			`receipt_status` int(11) NOT NULL,
			`group` int(11) NOT NULL,
			PRIMARY KEY (`receipt_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1"; */

		  /* $sql="CREATE TABLE IF NOT EXISTS `tbl_branch_receipthead` (
			`receipt_id` int(11) NOT NULL AUTO_INCREMENT,
			`receipt_branch_id_fk` varchar(100) NOT NULL,
			`fin_year` varchar(100) NOT NULL,
			`receipt_head` varchar(250) NOT NULL,
			`receipt_desc` varchar(255) NOT NULL,
			`receipt_date` date NOT NULL,
			`receipt_status` int(11) NOT NULL,
			PRIMARY KEY (`receipt_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1"; */

		 /*  $sql="CREATE TABLE IF NOT EXISTS `tbl_branch_voucher` (
			`voucher_id` int(11) NOT NULL AUTO_INCREMENT,
			`branch_id_fk` int(11) NOT NULL,
			`vouch_id_fk` int(11) NOT NULL,
			`finyear_id_fk` int(11) NOT NULL,
			`voucher_number` varchar(50) NOT NULL,
			`voucher_amount` varchar(100) NOT NULL,
			`paid_to` varchar(200) NOT NULL,
			`voucher_date` date NOT NULL,
			`narration` varchar(250) NOT NULL,
			`voucher_status` int(11) NOT NULL,
			`voucher_group` int(11) NOT NULL,
			PRIMARY KEY (`voucher_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1"; */

		/*   $sql="CREATE TABLE IF NOT EXISTS `tbl_branch_vouchhead` (
			`vouch_id` int(11) NOT NULL AUTO_INCREMENT,
			`vouch_branch_id_fk` varchar(100) NOT NULL,
			`fin_year` varchar(100) NOT NULL,
			`vouch_head` varchar(250) NOT NULL,
			`vouch_desc` varchar(255) NOT NULL,
			`vouch_date` date NOT NULL,
			`vouch_status` int(11) NOT NULL,
			PRIMARY KEY (`vouch_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1"; */

		 // $sql="ALTER TABLE `tbl_bank` ADD `bank_branch_id_fk` INT NOT NULL AFTER `bank_id`";

$sql="CREATE TABLE IF NOT EXISTS `tbl_incentive` (
	`incent_id` int(11) NOT NULL AUTO_INCREMENT,
	`incent_branch_id_fk` int(11) NOT NULL,
	`incent_member_id_fk` int(11) NOT NULL,
	`incent_date` date NOT NULL,
	`incent_total_purchase_amt` float NOT NULL,
	`incent_percent` int(11) NOT NULL,
	`incent_amount` float NOT NULL,
	`incent_from_date` date NOT NULL,
	`incent_to_date` date NOT NULL,
	`incent_status` int(11) NOT NULL,
	PRIMARY KEY (`incent_id`)
  ) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1";
		
		//$sql="TRUNCATE TABLE `tbl_branch_transfer`";
		$query = $this->db->query($sql);
		 if($query){ echo "Success"; }else{ echo "Failed"; } die;
	}
}
