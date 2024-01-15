<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the base64-encoded image data from the POST request
    $base64Image = $_POST["imageData"];

    // Remove the data URI prefix
    $base64Image = str_replace('data:image/png;base64,', '', $base64Image);

    // Decode the base64-encoded image data
    $imageData = base64_decode($base64Image);

    // Generate a unique filename for the image
    $filename = 'uploaded_image_' . uniqid() . '.png';

    // Specify the directory where you want to save the images
    $uploadDirectory = 'uploads/';

    // Ensure the directory exists; create it if not
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    // Specify the full path to the saved image
    $filePath = $uploadDirectory . $filename;

    // Save the image to the specified path
    file_put_contents($filePath, $imageData);

    // Provide a response to the client
    echo json_encode(['status' => 'success', 'message' => 'Image uploaded successfully.']);
} else {
    // If the request is not a POST request, return an error
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>