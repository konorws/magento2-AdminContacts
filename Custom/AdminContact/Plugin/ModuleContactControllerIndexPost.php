<?

namespace Custom\AdminContact\Plugin;

class ModuleContactControllerIndexPost
{
    protected $request;
    protected $_objectManager;
    
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectmanager,
        \Magento\Framework\App\Request\Http $request
    ) {
        $this->_objectManager = $objectmanager;
        $this->request = $request;
    }

	public function afterExecute()
	{
		$post = $this->request->getPostValue();
 		
 		if($post){

            $error = false;

 			if (!\Zend_Validate::is(trim($post['name']), 'NotEmpty')) {
                $error = true;
            }
            if (!\Zend_Validate::is(trim($post['comment']), 'NotEmpty')) {
                $error = true;
            }
            if (!\Zend_Validate::is(trim($post['email']), 'EmailAddress')) {
                $error = true;
            }
            if ($error) {
                throw new \Exception();
            }

            $contactModel = $this->_objectManager->create('Custom\AdminContact\Model\Contact');
            $data = array(
                'name'          => $post['name'],
                'email'         => $post['email'],
                'telephone'     => $post['telephone'],
                'comment'       => $post['comment'],
                'creation_time' => date('Y:m:d H:i:s'),
                'status'        => 0
            );

            $result = $contactModel->setData($data)->save();
             
 		}    
        
	}
}