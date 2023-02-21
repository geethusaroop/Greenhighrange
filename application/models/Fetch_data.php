<?php
class Fetch_data extends CI_Model{
    public function voucher(){
    	$this->db->where('entry_status',1);
        $query = $this->db->get('tbl_voucherentry');
        return $query->result();
    }
    public function voucher_details($id){
        $this->db->where('voucher_id',$id);
        $query = $this->db->get('tbl_voucherdetails');
        return $query->row();
    }
    public function receipt_details($id){
        $this->db->where('receipt_id',$id);
        $query = $this->db->get('tbl_receiptdetails');
        return $query->row();
    }
    public function receipt(){
    	$this->db->where('entry_status',1);
        $query = $this->db->get('tbl_receiptentry');
        return $query->result();
    }
    public function newreceipt(){
        $this->db->where('receipt_status',1);
        $query = $this->db->get('tbl_receiptdetails');
        return $query->result();
    }
    public function newvoucher(){
        $this->db->where('voucher_status',1);
        $query = $this->db->get('tbl_voucherdetails');
        return $query->result();
    }
    public function users(){
    	$query = $this->db->get('admin_login');
        return $query->result();
    }
    /*public function rooms($id,$hid){
        $this->db->where('occupied',0);
        $this->db->where('room_type',$id);
		$this->db->where('hotel_name',$hid);
        $query = $this->db->get('tbl_roomdetails');
        return $query->result();
    }*/
      public function rooms($id){
        $this->db->where('occupied',0);
        $this->db->where('room_type',$id);
       // $this->db->where('hotel_name',$hid);
        $query = $this->db->get('tbl_roomdetails');
        return $query->result();
    }

     public function rooms1($id,$ac,$cat){
        $this->db->where('occupied',0);
        $this->db->where('room_type',$id);
         $this->db->where('room_ac',$ac);
          $this->db->where('room_category',$cat);
       // $this->db->where('hotel_name',$hid);
        $query = $this->db->get('tbl_roomdetails');
        return $query->result();
    }
    public function room_id($id){
        $this->db->where('room_id',$id);
        $query = $this->db->get('tbl_roomdetails');
        return $query->result();
    }
	public function room_list(){
        $this->db->where('room_status',1);
		$this->db->where('hotel_name',1);
        $query = $this->db->get('tbl_roomdetails');
        return $query->result();
    }
	public function room_listint(){
        $this->db->where('room_status',1);
		$this->db->where('hotel_name',2);
        $query = $this->db->get('tbl_roomdetails');
        return $query->result();
    }
    public function rate(){
        for ($i=1; $i <=12 ; $i++) { 
        $this->db->where('checkin_status',1);    
            $this->db->where('MONTH(checkin_date)',$i);
            $query = $this->db->get('tbl_checkin');
            $no[$i]=$query->num_rows();
        }
        return $no;
    }
    public function checkout(){
        for ($i=1; $i <=12 ; $i++) {
        $this->db->where('checkout_status',1);     
            $this->db->where('MONTH(checkout_date)',$i);
            $query = $this->db->get('tbl_checkout');
            $no[$i]=$query->num_rows();
        }
        return $no;
    }
    public function reservation(){
        for ($i=1; $i <=12 ; $i++) {
        $this->db->where('reserv_status',1);     
            $this->db->where('MONTH(created_date)',$i);
            $query = $this->db->get('tbl_reservation');
            $no[$i]=$query->num_rows();
        }
        return $no;
    }
    public function revenue(){
        $this->db->select('(SELECT SUM(subtotal) FROM tbl_checkin WHERE checkin_status=1) AS amount');
        $query = $this->db->get();
        $rs1= $query->row();
        $this->db->select('(SELECT SUM(entry_amount) FROM tbl_receiptentry WHERE entry_status=1) AS amount');
        $query = $this->db->get();
        $rs2= $query->row();
        $result=$rs1->amount+$rs2->amount;
        return $result;
    }
    public function expense(){
        $this->db->select('(SELECT SUM(entry_amount) FROM tbl_voucherentry WHERE entry_status=1) AS amount');
        $query = $this->db->get();
        return $query->row();
    }
    public function getReceiptTable(){

        $this->db->where("entry_status",1);
        // $this->db->where('fin_year', $rs->fin_year);
        
        $this->db->select('*');
        $this->db->from('tbl_receiptentry');
        $this->db->join('tbl_receiptdetails','tbl_receiptentry.receipt_head=tbl_receiptdetails.receipt_id');
        $this->db->order_by('entry_id', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();
        //exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $query->num_rows();
        $data['recordsFiltered'] = $query->num_rows();
        return $data;

    }
    public function getVoucherTable(){

        $this->db->where("entry_status",1);
        // $this->db->where('fin_year', $rs->fin_year);
        
        $this->db->select('*');
        $this->db->from('tbl_voucherentry');
        $this->db->join('tbl_voucherdetails','tbl_voucherentry.voucher_head=tbl_voucherdetails.voucher_id');
        $this->db->order_by('entry_id', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();
        //exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $query->num_rows();
        $data['recordsFiltered'] = $query->num_rows();
        return $data;

    }
    public function getHeadsTable($change){

		if($change == 0)
		{
			$this->db->select('rec_id AS id, receipt_id AS edit, account_head, amount, narration, fin_year, created_date, type');
			$this->db->where('receipt_status', 1);
			$this->db->from('tbl_receiptdetails');
			$query1 = $this->db->get_compiled_select();

			$this->db->select('vouch_id AS id, voucher_id AS edit, account_head, amount, narration, fin_year, created_date, type');
			$this->db->where('voucher_status', 1);
			$this->db->from('tbl_voucherdetails');
			$query2 = $this->db->get_compiled_select();

			$query = $this->db->query($query1 . ' UNION ' . $query2);

			$data['data'] = $query->result();
			$data['recordsTotal'] = $query->num_rows();
			$data['recordsFiltered'] = $query->num_rows();
			return $data;
		}
		else if($change == 1)
		{
			$this->db->select('rec_id AS id, receipt_id AS edit, account_head, amount, narration, fin_year, created_date, type');
			$this->db->where('receipt_status', 1);
			$this->db->from('tbl_receiptdetails');
			$query = $this->db->get();
			
			$data['data'] = $query->result();
			$data['recordsTotal'] = $query->num_rows();
			$data['recordsFiltered'] = $query->num_rows();
			return $data;
		}
		else if($change == 2)
		{
			$this->db->select('vouch_id AS id, voucher_id AS edit, account_head, amount, narration, fin_year, created_date, type');
			$this->db->where('voucher_status', 1);
			$this->db->from('tbl_voucherdetails');
			$query = $this->db->get();
			
			$data['data'] = $query->result();
			$data['recordsTotal'] = $query->num_rows();
			$data['recordsFiltered'] = $query->num_rows();
			return $data;
		}			
        

    }
    public function getVoucherReport($param){

        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if(($start_date=='')&&($end_date=='')){
            $start_date='......';
            $end_date='......';
        }
        $query1 = $this->db->get('tbl_finyear');
        $rs=$query1->row();
        
        if($start_date){
            $this->db->where('entry_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('entry_date <=', $end_date); 
        }
        
        $this->db->where("entry_status",1);
        // $this->db->where('fin_year', $rs->fin_year);
        
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
        $this->db->select('*');
        $this->db->from('tbl_voucherentry');
        $this->db->join('tbl_voucherdetails','tbl_voucherentry.voucher_head=tbl_voucherdetails.voucher_id');
        $this->db->order_by('entry_id', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();
        //exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $query->num_rows();
        $data['recordsFiltered'] = $query->num_rows();
        return $data;

    }
    public function getReceiptReport($param){

        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if(($start_date=='')&&($end_date=='')){
            $start_date='......';
            $end_date='......';
        }
        $query1 = $this->db->get('tbl_finyear');
        $rs=$query1->row();
        
        if($start_date){
            $this->db->where('entry_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('entry_date <=', $end_date); 
        }
        
        $this->db->where("receipt_status",1);
        // $this->db->where('fin_year', $rs->fin_year);
        
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
        $this->db->select('*');
        $this->db->from('tbl_receiptentry');
        $this->db->join('tbl_receiptdetails','tbl_receiptentry.receipt_head=tbl_receiptdetails.receipt_id');
        $this->db->order_by('receipt_id', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();
        //exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $query->num_rows();
        $data['recordsFiltered'] = $query->num_rows();
        return $data;

    }
	public function outofservice(){
        $this->db->where("room_active",1);
        $this->db->where("room_status",1);
        $query = $this->db->get('tbl_roomdetails');
        return $query->num_rows();
    }
    public function occupied(){
        $this->db->where("cin_status",1);
        $this->db->where("checkin_status",1);
        $query = $this->db->get('tbl_checkin');
        return $query->num_rows();
    }
    public function available(){
        $this->db->where("occupied",0);
		$this->db->where("room_active",0);
        $query = $this->db->get('tbl_roomdetails');
        return $query->num_rows();
    }
    public function bookings(){
        $this->db->where("reserv_status",1);
        $query = $this->db->get('tbl_reservation');
        return $query->num_rows();
    }
    public function bookings_yr(){
        $this->db->where('finyear_status', 1);
        $query1 = $this->db->get('tbl_finyear');
        $rs=$query1->row();
        $this->db->where('fin_year', $rs->fin_year);
        $this->db->where("reserv_status",1);
        $query = $this->db->get('tbl_reservation');
        return $query->num_rows();
    }
    public function checkin(){
        $this->db->where("checkin_status",1);
        $query = $this->db->get('tbl_checkin');
        return $query->num_rows();
    }
    public function checkin_yr(){
        $this->db->where('finyear_status', 1);
        $query1 = $this->db->get('tbl_finyear');
        $rs=$query1->row();
        $this->db->where('fin_year', $rs->fin_year);
        $this->db->where("checkin_status",1);
        $query = $this->db->get('tbl_checkin');
        return $query->num_rows();
    }
    public function fin_year(){
        $this->db->where('finyear_status', 1);
        $query1 = $this->db->get('tbl_finyear');
        return $query1->row();
    }

}