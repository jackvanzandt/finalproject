<?php
if (function_exists('oci_connect')) {
    echo "OCI8 is available";
} else {
    echo "OCI8 is not available";
}

