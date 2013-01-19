<?php
class NeuForm extends CFormModel
{
	public $grobphase_id = array();	
	public $unterphase_id = array();
	public function rules()
	{
		return array(
			
		);
	}
	public function getId(){
		return $this->grobphase_id;
		}
}