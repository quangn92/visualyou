<?php

/**
 * Ceon Manual Card Language Definitions.
 *
 * @package     ceon_manual_card
 * @author      Conor Kerr <zen-cart.ceon-manual-card@ceon.net>
 * @author      Elba M. Martinez (http://www.ideascg.com)
 * @copyright   Copyright 2006-2012 Ceon
 * @copyright   Portions Copyright 2003-2006 Zen Cart Development Team
 * @copyright   Portions Copyright 2003 osCommerce
 * @link        http://ceon.net/software/business/zen-cart/ceon-manual-card
 * @license     http://www.gnu.org/copyleft/gpl.html   GNU Public License V2.0
 * @version     $Id: ceon_manual_card.php 1093 2012-11-14 19:03:30Z conor $
 */

// HTML is allowed in the following message!
define('CEON_MANUAL_CARD_CUSTOM_SURCHARGES_DISCOUNTS_MESSAGE', '');


/**
 * Default (fallback) definitions for information about card surcharges/discounts. The "SHORT" version is added
 * after the card's title in the Card Type selection gadget. The "LONG" version is used as the title for the Order
 * Total Summary Line in the Ceon Payment Surcharges Discounts Order Total module.
 *
 * These are only used if no text was specified for a Card Type which is making use of the surcharge/discount
 * functionality.
 */
define('CEON_MANUAL_CARD_TEXT_SURCHARGE_SHORT', 'Recargo');
define('CEON_MANUAL_CARD_TEXT_SURCHARGE_LONG', 'Sobrecarga de la Tarjeta');
define('CEON_MANUAL_CARD_TEXT_DISCOUNT_SHORT', 'Descuento');
define('CEON_MANUAL_CARD_TEXT_DISCOUNT_LONG', 'Descuento de la Tarjeta');


// The remaining definitions should rarely require changing but feel free if you like! //////

/**
 * Payment option title as displayed to the customer.
 */
define('CEON_MANUAL_CARD_TEXT_CATALOG_TITLE', 'Tarjeta de Crédito/Débito');

/**
 * The labels for the card fields.
 */
define('CEON_MANUAL_CARD_TEXT_CARDS_ACCEPTED', 'Tarjetas Aceptadas:');
define('CEON_MANUAL_CARD_TEXT_CARD_TYPE', 'Tipo de Tarjeta:');
define('CEON_MANUAL_CARD_TEXT_CARD_HOLDER', 'Nombre en la Tarjeta:');
define('CEON_MANUAL_CARD_TEXT_CARD_NUMBER', 'Número de Tarjeta:');
define('CEON_MANUAL_CARD_TEXT_CARD_EXPIRY_DATE', 'Fecha de Expiración');
define('CEON_MANUAL_CARD_TEXT_CARD_CV2_NUMBER', 'Número CV2:');
define('CEON_MANUAL_CARD_TEXT_CARD_CV2_NUMBER_WITH_POPUP_LINK', 'Número de CV2 (<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_CVV_HELP) . '\')">' . 'Más Info' . '</a>):');
define('CEON_MANUAL_CARD_TEXT_CARD_CV2_NUMBER_TICK_NOT_PRESENT', 'Haga click aquí si su tarjeta no tiene CV2');
define('CEON_MANUAL_CARD_TEXT_CARD_CV2_NUMBER_NOT_PRESENT', 'No existe.');
define('CEON_MANUAL_CARD_TEXT_CARD_START_DATE_IF_ON_CARD', 'Fecha de Expedición (Si está impresa):');
define('CEON_MANUAL_CARD_TEXT_CARD_START_DATE', 'Fecha de Expedición:');
define('CEON_MANUAL_CARD_TEXT_CARD_ISSUE_NUMBER_IF_ON_CARD', 'Número de Expedición de la tarjeta (Si está impresa):');
define('CEON_MANUAL_CARD_TEXT_CARD_ISSUE_NUMBER', 'Número de Expedición de la tarjeta:');

define('CEON_MANUAL_CARD_TEXT_SELECT_CARD_TYPE', 'Seleccione el Tipo de Tarjeta');

define('CEON_MANUAL_CARD_TEXT_SELECT_MONTH', 'Mes');
define('CEON_MANUAL_CARD_TEXT_SELECT_YEAR', 'Año');

define('CEON_MANUAL_CARD_TEXT_VISA', 'Visa');
define('CEON_MANUAL_CARD_TEXT_MASTERCARD', 'MasterCard');
define('CEON_MANUAL_CARD_TEXT_VISA_DEBIT', 'Visa Debit');
define('CEON_MANUAL_CARD_TEXT_MASTERCARD_DEBIT', 'MasterCard Debit');
define('CEON_MANUAL_CARD_TEXT_MAESTRO', 'Maestro');
define('CEON_MANUAL_CARD_TEXT_VISA_ELECTRON', 'Visa Electron (UKE)');
define('CEON_MANUAL_CARD_TEXT_AMERICAN_EXPRESS', 'American Express');
define('CEON_MANUAL_CARD_TEXT_DINERS_CLUB', 'Diners Club');
define('CEON_MANUAL_CARD_TEXT_JCB', 'JCB');
define('CEON_MANUAL_CARD_TEXT_LASER', 'Laser');
define('CEON_MANUAL_CARD_TEXT_DISCOVER', 'Discover');

/**
 * Definitions used when generating the e-mail.
 */
define('CEON_MANUAL_CARD_TEXT_EMAIL_SUBJECT', 'Información Adicional para la Orden #');
define('CEON_MANUAL_CARD_TEXT_EMAIL' , "Aquí están los dígitos intermedios de la tarjeta de crédito para la Orden #%s:\n\nNúmeros Intermedios: %s\n\nY aquí está el Número CV2:\n\nCV2 Número: %s\n\nNO DEBERIA ALMACENAR EL NUMERO CV2 EN SU TIENDA... BORRE ESTE EMAIL UNA VEZ HAYA HECHO EL CARGO A LA TARJETA!");
define('CEON_MANUAL_CARD_TEXT_EMAIL_CV2_NUMBER_NOT_PRESENT' , "Aquí están los Dígitos Intermedios de la tarjeta de crédito para la Orden #%s:\n\nNúmeros Intermedios: %s\n\nEl cliente indicó que su tarjeta de crédito no tiene número CV2.\n\nNO DEBERIA ALMACENAR EL NUMERO CV2 EN SU TIENDA... BORRE ESTE EMAIL UNA VEZ HAYA HECHO EL CARGO A LA TARJETA!");
define('CEON_MANUAL_CARD_TEXT_EMAIL_CV2_NUMBER_NOT_REQUESTED' , "Aquí están los Dígitos Intermedios de la tarjeta de crédito para la Orden #%s:\n\nNúmeros Intermedios: %s\n\nNO DEBERIA ALMACENAR EL NUMERO CV2 EN SU TIENDA... BORRE ESTE EMAIL UNA VEZ HAYA HECHO EL CARGO A LA TARJETA!");

/**
 * Default definitions for the error messages to be displayed when a card details form field's value is missing or
 * wrong. HTML can be used.
 */
define('CEON_MANUAL_CARD_ERROR_CARD_HOLDER_REQUIRED', '<span class="ErrorInfo">El nombre en la tarjeta debe tener al menos ' . (is_numeric(CC_OWNER_MIN_LENGTH) ? CC_OWNER_MIN_LENGTH : 2) . ' caracteres.</span>');
define('CEON_MANUAL_CARD_ERROR_CARD_HOLDER_MIN_LENGTH', '<span class="ErrorInfo">El nombre en la tarjeta debe tener al menos ' . (is_numeric(CC_OWNER_MIN_LENGTH) ? CC_OWNER_MIN_LENGTH : 2) . ' caracteres.</span>');
define('CEON_MANUAL_CARD_ERROR_CARD_TYPE', '<span class="ErrorInfo">Debe seleccionar el tipo de tarjetas de crédito/débito que está utilizando.</span>');
define('CEON_MANUAL_CARD_ERROR_CARD_NUMBER_REQUIRED', '<span class="ErrorInfo">El número de la tarjeta debe tener al menos ' . (is_numeric(CC_NUMBER_MIN_LENGTH) ?  CC_NUMBER_MIN_LENGTH : 16) . ' dígitos.</span>');
define('CEON_MANUAL_CARD_ERROR_CARD_NUMBER_INVALID', '<span class="ErrorInfo">El número de tarjeta de crédito entrado es inválido. Favor verificar y tratar de nuevo, trate otra tarjeta o <a href="' . zen_href_link(FILENAME_CONTACT_US, '', 'SSL') . '">contáctenos</a> para asistencia.</span>');
define('CEON_MANUAL_CARD_ERROR_MASTERCARD_CREDIT_NOT_ACCEPTED', '<span class="ErrorInfo">You have entered a MasterCard Credit Card number but we don\'t accept MasterCard Credit cards.</span>');
define('CEON_MANUAL_CARD_ERROR_MASTERCARD_DEBIT_NOT_ACCEPTED', '<span class="ErrorInfo">You have entered a MasterCard Debit Card number but we don\'t accept MasterCard Debit cards.</span>');
define('CEON_MANUAL_CARD_ERROR_CARD_IS_MASTERCARD_DEBIT_NOT_CREDIT', '<span class="ErrorInfo">You have selected MasterCard Credit Card but entered the number of a MasterCard Debit Card.</span>');
define('CEON_MANUAL_CARD_ERROR_CARD_IS_MASTERCARD_CREDIT_NOT_DEBIT', '<span class="ErrorInfo">You have selected MasterCard Debit Card but entered the number of a MasterCard Credit Card.</span>');
define('CEON_MANUAL_CARD_ERROR_CARD_EXPIRY_DATE_INVALID', '<span class="ErrorInfo">La fecha de expiración entrada para la tarjeta es inválida.</span>');
define('CEON_MANUAL_CARD_ERROR_CARD_CV2_NUMBER_REQUIRED_NOT_AMERICAN_EXPRESS', '<span class="ErrorInfo">Los 3 dígitos del CV2 deben ser copiados de la parte de atrás de la tarjeta.</span>');
define('CEON_MANUAL_CARD_ERROR_CARD_CV2_NUMBER_MISSING_INDICATE_NOT_AMERICAN_EXPRESS', '<span class="ErrorInfo">El número CV2 no ha sido entrado. Favor de entrar el número otra vez, o indique si la tarjeta no tiene número CV2.</span>');
define('CEON_MANUAL_CARD_ERROR_CARD_CV2_NUMBER_INVALID_NOT_AMERICAN_EXPRESS', '<span class="ErrorInfo">El número CV2 entrado es inválido.</span>');
define('CEON_MANUAL_CARD_ERROR_CARD_CV2_NUMBER_REQUIRED_AMERICAN_EXPRESS', '<span class="ErrorInfo">Los 4 dígitos del CV2 deben ser copiados de la parte delantera de la tarjeta.</span>');
define('CEON_MANUAL_CARD_ERROR_CARD_CV2_NUMBER_MISSING_INDICATE_AMERICAN_EXPRESS', '<span class="ErrorInfo">El número CV2 no ha sido entrado. Favor de entrar el número otra vez, o indique si la tarjeta no tiene número CV2.</span>');
define('CEON_MANUAL_CARD_ERROR_CARD_CV2_NUMBER_INVALID_AMERICAN_EXPRESS', '<span class="ErrorInfo">El número CV2 entrado es inválido.</span>');
define('CEON_MANUAL_CARD_ERROR_CARD_CV2_NUMBER_REQUIRED_POSS_AMERICAN_EXPRESS', '<span class="ErrorInfo">Los 3 o 4 dígitos del CV2 deben ser copiados de la parte de atrás de la tarjeta o de la parte delantera de la tarjeta.</span>');
define('CEON_MANUAL_CARD_ERROR_CARD_CV2_NUMBER_MISSING_INDICATE_POSS_AMERICAN_EXPRESS', '<span class="ErrorInfo">El número CV2 no ha sido entrado. Favor de entrar el número otra vez, o indique si la tarjeta no tiene número CV2.</span>');
define('CEON_MANUAL_CARD_ERROR_CARD_CV2_NUMBER_INVALID_POSS_AMERICAN_EXPRESS', '<span class="ErrorInfo">El número CV2 entrado es inválido.</span>');
define('CEON_MANUAL_CARD_ERROR_CARD_START_DATE_INVALID', '<span class="ErrorInfo">La fecha de expedición entrada para la tarjeta es inválida.</span>');

/**
 * Default definitions for the error messages to be displayed using JavaScript when a card details form field's
 * value is missing or wrong.
 */
define('CEON_MANUAL_CARD_ERROR_JS_CARD_HOLDER_MIN_LENGTH', '* El nombre en la tarjeta debe tener al menos ' . (is_numeric(CC_OWNER_MIN_LENGTH) ? CC_OWNER_MIN_LENGTH : 2) . ' caracteres.\n');
define('CEON_MANUAL_CARD_ERROR_JS_CARD_TYPE', '* Debe seleccionar el tipo de Tarjeta de Crédito/Déito que usted está utilizando.\n');
define('CEON_MANUAL_CARD_ERROR_JS_CARD_NUMBER_MIN_LENGTH', '* El número de la tarjeta debe tener al menos ' . (is_numeric(CC_NUMBER_MIN_LENGTH) ?  CC_NUMBER_MIN_LENGTH : 16) . ' dígitos.\n');
define('CEON_MANUAL_CARD_ERROR_JS_CARD_EXPIRY_DATE_INVALID', '* Debe seleccionar la fecha de expiración de la tarjeta que está utilizando.\n');
define('CEON_MANUAL_CARD_ERROR_JS_CARD_CV2_NUMBER_INVALID_NOT_AMERICAN_EXPRESS', '* Los 3 dígitos del CV2 deben ser copiados de la parte de atrás de la tarjeta.\n');
define('CEON_MANUAL_CARD_ERROR_JS_CARD_CV2_NUMBER_INVALID_INDICATE_NOT_AMERICAN_EXPRESS', '* Los 3 dígitos del CV2 deben ser copiados de la parte de atrás de la tarjeta,\n--> solamente si la tarjeta no tiene número CV2, la opción para indicar que no lo tiene debe ser marcada.\n');
define('CEON_MANUAL_CARD_ERROR_JS_CARD_CV2_NUMBER_INVALID_AMERICAN_EXPRESS', '* Los 4 dígitos del CV2 deben ser copiados de la parte delantera de la tarjeta.\n');
define('CEON_MANUAL_CARD_ERROR_JS_CARD_CV2_NUMBER_INVALID_INDICATE_AMERICAN_EXPRESS', '* Los 4 dígitos del CV2 deben ser copiados de la parte delantera de la tarjeta,\n--> solamente si la tarjeta no tiene número CV2, la opción para indicar que no lo tiene debe ser marcada.\n');
define('CEON_MANUAL_CARD_ERROR_JS_CARD_CV2_NUMBER_INVALID_POSS_AMERICAN_EXPRESS', '* Los 3 o 4 dígitos del CV2 deben ser copiados de la parte de atrás de la tarjeta o de la parte delantera de la tarjeta.\n');
define('CEON_MANUAL_CARD_ERROR_JS_CARD_CV2_NUMBER_INVALID_INDICATE_POSS_AMERICAN_EXPRESS', '* Los 3 o 4 dígitos del CV2 deben ser copiados de la parte de atrás de la tarjeta o de la parte delantera de la tarjeta,\n--> solamente si la tarjeta no tiene número CV2, la opción para indicar que no lo tiene debe ser marcada.\n');
define('CEON_MANUAL_CARD_ERROR_JS_CARD_START_DATE_INVALID', '* Ha seleccionado una fecha de expedición inválida\n--> Favor seleccionar una fecha de expedición válida o reseleccionar a \"Mes\" \"Año\" si su tarjeta no tiene fecha de expedición.\n');

/**
 * Admin text definitions.
 */
define('CEON_MANUAL_CARD_TEXT_ADMIN_TITLE', 'Ceon Manual Card v%s');
define('CEON_MANUAL_CARD_TEXT_DESCRIPTION', '<fieldset style="background: #f7f6f0; margin-bottom: 1.5em"><legend style="font-size: 1.2em; font-weight: bold">Detalles de la Tarjeta para la prueba</legend>Un número válido de Tarjeta de Crédito/Débito debe ser utilizado (Ej. 4111111111111111).<br /><br />Cualquier fecha futura puede ser utilizada como fecha de expiración y cualquiera 3 o 4 (AMEX) dígitos pueden ser utilizados para el código CV2.<br /><br />Maestro pueden opcionalmente utilizar una Fecha de Expedición y/o Número de Expedición.<br /><br />Tarjetas American Express siempre tienen y requieren una fecha de expedición (aunque este módulo no hace obligatoria la entrada).');
define('CEON_MANUAL_CARD_TEXT_NOT_INSTALLED', '<a href="http://ceon.net/software/business/zen-cart" target="_blank"><img src="' . DIR_WS_IMAGES . 'ceon-button-logo.png" alt="Realizados por Ceon. &copy; 2006-' . (date('Y') > 2012 ? date('Y') : 2012) . ' Ceon" align="right" style="margin: 1em 0.2em; border: none;" /></a><br />Módulo &copy; 2006-' . (date('Y') > 2012 ? date('Y') : 2012) . ' <a href="http://ceon.net/software/business/zen-cart" target="_blank">Ceon</a>');

define('CEON_MANUAL_CARD_ADMIN_TEXT_TITLE', 'Ceon Manual Card');

define('CEON_MANUAL_CARD_ADMIN_TEXT_DELETE_DETAILS', 'Delete Card Details');
define('CEON_MANUAL_CARD_ADMIN_TEXT_CONFIRM_DELETE_DETAILS', 'Are you sure you want to permanently delete the card details?');
define('CEON_MANUAL_CARD_ADMIN_TEXT_DETAILS_DELETED_CONFIRMED_NOTICE', 'The card details were deleted at {ceon:time} on {ceon:date} by {ceon:admin-user-name}.');
define('CEON_MANUAL_CARD_ADMIN_TEXT_DETAILS_DELETION_JUST_TOOK_PLACE', 'Some details may still be displayed above as any details output above were output before the deletion took place. Rest assured though that the details have been deleted.');

define('CEON_MANUAL_CARD_ADMIN_TEXT_DETAILS_DELETED_NOTICE', 'The card details were deleted at {ceon:time} on {ceon:date} by {ceon:admin-user-name}.');
define('CEON_MANUAL_CARD_ADMIN_TEXT_EMAIL_NOTICE', 'Los dígitos intermedio de la tarjeta arriba mencionada y cualquier número CV2 ha sido enviada al email configurado en el módulo.');
define('CEON_MANUAL_CARD_ADMIN_TEXT_NO_CV2_NUMBER', 'Dígitos del CV2 no se entró.').
define('CEON_MANUAL_CARD_ADMIN_TEXT_NO_START_DATE_OR_ISSUE_NUMBER', 'No hay fecha de expedición fue seleccionada y número de expedición no se entró.').
define('CEON_MANUAL_CARD_ADMIN_TEXT_NO_START_DATE', 'No hay fecha de expedición fue seleccionada.').
define('CEON_MANUAL_CARD_ADMIN_TEXT_NO_ISSUE_NUMBER', 'Número de expedición no se entró.').
define('CEON_MANUAL_CARD_ADMIN_TEXT_CARD_NUMBER', 'Número de la tarjeta:');
define('CEON_MANUAL_CARD_ADMIN_TEXT_CV2_NUMBER', 'Dígitos del CV2:');
define('CEON_MANUAL_CARD_ADMIN_TEXT_START_DATE', 'Fecha de Expedición:');
define('CEON_MANUAL_CARD_ADMIN_TEXT_ISSUE_NUMBER', 'Número de Expedición:');
