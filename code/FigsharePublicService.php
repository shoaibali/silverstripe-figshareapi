<?php

/**
 * Used to query Figshare API available to public
 *
 * @package figsharepublicservice
 */

class FigsharePublicService extends RestfulService {

   /**
     * Page number
     * Default: 1
     *
     * @var int
     */
    private $page; // Page number

    /**
     * The number of results included on a page
     * Default: 10
     *
     * @var int
     */
    private $pageSize;


    /**
     * Number of results included on a page
     * Default: 10
     *
     * @var int
     */
    private $limit;

    /**
     * Number of results included on a page
     * Default: 0
     *
     * @var int
     */
    private $offset;


    /**
     *
     * @param String $resource Resource can be article, author, category, collection etc
     */
    function __construct($resource){
        parent::__construct('https://api.figshare.com/v2/' . $resource);
    }


    /**
     * This will return API specific error messages.
     *
     * @param  HTTPResponse
     * @return String
     */
    function error(){
        return $response;
    }

    public function setPage($page){
        $this->page = $page;
    }

    public function setPageSize($pageSize){
        $this->pageSize = $pageSize;
    }

    public function setLimit($limit){
        $this->limit = $limit;
    }

    public function setOffset($offset){
        $this->offset = $offset;
    }

    public function getResource(){

        if (isset($this->limit) || isset($this->offset)) {
            if (isset($this->limit)) {
                $params["offset"] = $this->offset;
            }
            if (isset($this->limit)) {
                $params["limit"] = $this->limit;
            }
        }

        if (isset($this->pageSize) || isset($this->page)) {
            if (isset($this->pageSize)) {
                $params["page_size"] = $this->page_size;
            }
            if (isset($this->page)) {
                $params["page"] = $this->page;
            }
        }

        $params = array(
            'page' => $this->page,
            'offset' => $this->offset,
            'page_size' => $this->pageSize,
            'limit' => $this->limit
        );

        $this->setQueryString($params);
        $response = $this->request();

        $results = $response->getBody();
        return $results;
    }
}
