Add-Type -AssemblyName System.Drawing

$inputPath = "C:\Users\sakak\.gemini\antigravity-ide\brain\a8888a79-63ce-48c2-8682-87889840ac36\.user_uploaded\media_1787401739685.jpg"
if (-not (Test-Path $inputPath)) {
    $inputPath = "public\images\logo.jpg"
}

$src = [System.Drawing.Image]::FromFile($inputPath)
$srcW = $src.Width
$srcH = $src.Height

# The shield emblem is in the upper 70% of the image
# Let's crop from y = 10% to 70%, and x = 20% to 80%
$cropX = [int]($srcW * 0.20)
$cropY = [int]($srcH * 0.12)
$cropW = [int]($srcW * 0.60)
$cropH = [int]($srcH * 0.58)

$cropRect = New-Object System.Drawing.Rectangle($cropX, $cropY, $cropW, $cropH)
$destBmp = New-Object System.Drawing.Bitmap($cropW, $cropH)
$graphics = [System.Drawing.Graphics]::FromImage($destBmp)
$graphics.InterpolationMode = [System.Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
$graphics.SmoothingMode = [System.Drawing.Drawing2D.SmoothingMode]::HighQuality
$graphics.PixelOffsetMode = [System.Drawing.Drawing2D.PixelOffsetMode]::HighQuality

$graphics.DrawImage($src, (New-Object System.Drawing.Rectangle(0, 0, $cropW, $cropH)), $cropRect, [System.Drawing.GraphicsUnit]::Pixel)

$destBmp.Save('public\images\logo.png', [System.Drawing.Imaging.ImageFormat]::Png)
$destBmp.Save('public\images\logo-emblem.png', [System.Drawing.Imaging.ImageFormat]::Png)
$destBmp.Save('public\logo.png', [System.Drawing.Imaging.ImageFormat]::Png)

$graphics.Dispose()
$destBmp.Dispose()
$src.Dispose()

Write-Output "Cropped shield emblem: $cropW x $cropH"
