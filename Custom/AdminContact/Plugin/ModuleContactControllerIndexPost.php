<?

namespace Custom\AdminContact\Plugin;

class ModuleContactControllerIndexPost
{
    protected $request;
    
    public function __construct(
        \Magento\Framework\App\Request\Http $request
    ) {
        $this->request = $request;
    }

	public function afterExecute()
	{
		$post = $this->request->getPostValue();
 		
 		if($post){
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

            
 		}    
        
	}
}