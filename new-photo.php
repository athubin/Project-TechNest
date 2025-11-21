<?php
// Directory where your images are stored
$imageDir = 'images/';

// Get all image files from the directory
$images = array_diff(scandir($imageDir), array('.', '..'));

// Display the filenames as clickable links
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Viewer</title>
    <style>
        .image-preview {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 8px;
        }
        .image-preview img {
            max-width: 100%;
            max-height: 100vh;
        }
        .close-btn {
            color: white;
            font-size: 20px;
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
    </style>
    <script>
        function showImage(imagePath) {
            const preview = document.getElementById('image-preview');
            const imgElement = document.getElementById('preview-image');
            imgElement.src = imagePath;
            preview.style.display = 'block';
        }

        function closePreview() {
            document.getElementById('image-preview').style.display = 'none';
        }
    </script>
</head>
<body>
    <h1>Image Viewer</h1>
    <ul>
        <?php foreach ($images as $image): ?>
            <li>
                <a href="javascript:void(0);" onclick="showImage('<?php echo $imageDir . $image; ?>')">
                    <?php echo htmlspecialchars($image); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Image Preview Modal -->
    <div id="image-preview" class="image-preview">
        <span class="close-btn" onclick="closePreview()">×</span>
        <img id="preview-image" src="" alt="Preview">
    </div>
</body>
</html>
