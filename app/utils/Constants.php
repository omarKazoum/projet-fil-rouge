<?php
//for loggin screen
const LOGIN_ERROR_KEY='login_error';
//roles
const ROLE_TYPE_ADMIN=1;
const ROLE_TYPE_CUSTOMER=2;
const ROLE_TYPE_COIFFEUR=3;
const ROLE_KEY='role';
//for sign up screen and login screen
const USER_NAME_KEY="user_name";
const PASSWORD_KEY="password";
const PASSWORD_REPEAT_KEY="password2";
const FIRST_NAME_KEY='first_name';
const LAST_NAME_KEY='last_name';
const EMAIL_KEY='email';
const PHONE_KEY='phone';
const CITY_KEY='city';
const QUARTIER_KEY='adress';
const STORE_NAME_KEY='store_name';
const WORKING_HOURS_KEY='working_hours';
const WORKING_DAYS_KEY='working_days';
const PROFILE_IMG_KEY='profile_img';
//service constants
const SERVICE_ID_KEY='service_id';
const SERVICE_REQUEST_DATE_KEY='service_request_date';
const SERVICE_REQUEST_TIME_KEY='service_request_time';
const SERVICE_TITLE_KEY='service_title';
const SERVICE_DESCRIPTION_KEY='service_description';
const SERVICE_PRICE_KEY='service_price';
const SERVICE_CATEGORY_ID_KEY='category_id';
const SERVICE_IMG_KEY='service_img';
const IMG_NOT_UPLOADED_KEY='not_uploaded';
//service status
const SERVICE_REQUEST_STATUS_PENDING=1;
const SERVICE_REQUEST_STATUS_ACCEPTED=2;
const SERVICE_REQUEST_STATUS_REJECTED=3;
const SERVICE_REQUEST_STATUS_CANCELED=4;
//endpoints labels
const SERVICES_ENDPOINT_LABEL='services';
const SERVICE_REQUESTS_ENDPOINT_LABEL='service_requests';
const USERS_ENDPOINT_LABEL='users';
const CATEGORIES_ENDPOINT_LABEL='categories';
const AUTHENTICATION_ENDPOINT_LABEL='authentication';
//category constants
const CATEGORY_ID_KEY='category_id';
const CATEGORY_TITLE_KEY='category_title';
