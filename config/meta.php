<?php

return [

    'image_compress_value' => env('IMAGE_COMPRESS_VALUE', 75),
    'max_allowed_customer_import_rows' => env('MAX_ALLOWED_CUSTOMER_IMPORT_ROWS', 250),
    'amazon_s3_url' => env('AMAZON_S3_URL', 'https://s3.eu-west-1.amazonaws.com/cos.com.ge/'),
    'appointment_can_be_edited_before' => 1, //in days
    'max_appointment_participants' => 50, //in days

    'company_short_name' => 'COS',


];
