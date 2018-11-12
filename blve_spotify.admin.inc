<?php

/*
Formulario de Configuracion de parametros generales de Spotify
Al crear una app en la web de spotify, esta pide 3 credenciales
Secret Key, Public Key y un URI
*/
function blve_spotify_admin_form() {
	
   /**
   * Contenedor de parámetros de configuracion para la compra de productos
   */
   
  $form['spotify_client_info'] = array(
    '#type' => 'fieldset',
    '#title' => t('Application Information'),
    '#weight' => 5,
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
	
  $form['spotify_client_info']['spotify_client_id'] = array(
      '#title' => t('Client ID'),
      '#type' => 'textfield',
      '#required' => TRUE,
      '#default_value' => variable_get('spotify_client_id'),
  );
  $form['spotify_client_info']['spotify_client_secret'] = array(
      '#title' => t('Client secret'),
      '#type' => 'textfield',
      '#required' => TRUE,
      '#default_value' => variable_get('spotify_client_secret'),
  );

  $form['spotify_client_info']['spotify_client_URI'] = array(
      '#title' => t('Callback URL (URI)'),
      '#type' => 'textfield',
      '#required' => TRUE,
      '#default_value' => variable_get('spotify_client_URI'),
  );
  
  # the drupal checkboxes form field definition
  $form['spotify_client_info']['p_scopes'] = array(
	  '#title' => t('Permisos (Scopes) separados por coma'),
	  '#type' => 'textfield',
	  '#required' => TRUE,
      '#default_value' => variable_get('p_scopes'),
	);
  
  return system_settings_form($form);
}



