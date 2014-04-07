<?php
App::uses('AppController', 'Controller');
/**
 * DealsTags Controller
 *
 * @property DealsTag $DealsTag
 */
class DealsTagsController extends AppController {


    var $filters = array (  
            'index' => array (  
                'DealsTag' => array (
                    'DealsTag.name',  
                )  
            )  
    );  

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->DealsTag->recursive = 0;
		$this->set('dealsTags', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->DealsTag->id = $id;
		if (!$this->DealsTag->exists()) {
			throw new NotFoundException(__('Invalid deals tag'));
		}
		$this->set('dealsTag', $this->DealsTag->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DealsTag->create();
			if ($this->DealsTag->save($this->request->data)) {
				$this->Session->setFlash(__('The deals tag has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The deals tag could not be saved. Please, try again.'));
			}
		}
		$trparams = $this->params['named'];
		foreach ($trparams as $model=>$id) {
		        $this->request->data['DealsTag'][$model . '_id'] = $id;
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null, $type = null) {
		$this->DealsTag->id = $id;
		if (!$this->DealsTag->exists()) {
			throw new NotFoundException(__('Invalid deals tag'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($type === 'copy') {
				unset($this->request->data['DealsTag']['id']);
				$this->DealsTag->create();
			}
			if ($this->DealsTag->save($this->request->data)) {
				$this->Session->setFlash(__('The deals tag has been saved'));
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The deals tag could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->DealsTag->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->DealsTag->id = $id;
		if (!$this->DealsTag->exists()) {
			throw new NotFoundException(__('Invalid deals tag'));
		}
		if ($this->DealsTag->delete()) {
			$this->Session->setFlash(__('Deals tag deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Deals tag was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
