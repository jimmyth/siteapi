<?php

namespace Drupal\siteapi\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Controller SiteApiController
 * Controller for hnadle page responses.
 */
class SiteApiController extends ControllerBase {
  
  /**
   * {@inheritdoc}
   * 
   * @param string $apiKey
   *   A string to use, for API key.
   * @param integer $nodeId
   *   A numeric to use, Node ID.
   */
  public function getJson($apiKey, $nodeId) {
    $config = \Drupal::config('siteapi.settings');
    $siteapikey = $config->get('siteapikey');
    
    // Check if the API Key is Valid or not.
    if ($siteapikey == $apiKey) {
      // Check if the Node ID is Numeric and greater than 0.
      if (is_numeric($nodeId) && $nodeId > 0) {
        $node = \Drupal\node\Entity\Node::load($nodeId);
        // Check if the Node Type is page, created time, author, publishing status.
        if ( !empty($node) && $node->getType() === 'page' ){
          // Get node title, body, type, .
          $node_title = $node->getTitle();
          $node_body = $node->get('body')->getValue();
          $node_type = $node->getType();
          $node_created = $node->getCreatedTime();
          $node_author = $node->getOwner()->id();
          $node_status = $node->isPublished();
          // Build JSON response
          $json_response = [
            'nodeID' => $nodeId,
            'title' => $node_title,
            'body' => $node_body,
            'nodeType' => $node_type,
            'created' => $node_created,
            'uid' => $node_author,
            'publishedStatus' => $node_status,
          ];

          // Return the JSON Response.
          $data = ['http_code' => '200', 'values' => $json_response];
          return new JsonResponse($data);
        }
        else {
          $data = ['http_code' => '403', 'values' => ['Err_msg' => 'Access denied', 
            'Solution' => t('Accept only page type.')]];
        }
      }
      else {
        $data = ['http_code' => '403', 'values' => ['Err_msg' => 'Access denied', 
          'Solution' => t('Please Enter Valid Node Id')]];
      }
    }
    else {
      $data = ['http_code' => '403', 'values' => ['Err_msg' => 'Access denied',
      'Solution' => t('Please Enter Valid Site API KEY')]];
    }

    // Return the JSON Response.
    $response = new Response(
      json_encode($data),
      Response::HTTP_FORBIDDEN,
      array('content-type' => 'application/json')
    );
    //throw new AccessDeniedHttpException();
    return $response;
  }
    
}
