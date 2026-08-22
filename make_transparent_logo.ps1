Add-Type -AssemblyName System.Drawing

$inputPath = "C:\Users\sakak\.gemini\antigravity-ide\brain\a8888a79-63ce-48c2-8682-87889840ac36\.user_uploaded\media_1787401739685.jpg"
if (-not (Test-Path $inputPath)) {
    $inputPath = "public\images\logo.jpg"
}

$src = [System.Drawing.Image]::FromFile($inputPath)
$srcW = $src.Width
$srcH = $src.Height

# Crop the shield emblem tightly
$cropX = [int]($srcW * 0.23)
$cropY = [int]($srcH * 0.14)
$cropW = [int]($srcW * 0.54)
$cropH = [int]($srcH * 0.54)

$cropRect = New-Object System.Drawing.Rectangle($cropX, $cropY, $cropW, $cropH)
$croppedBmp = New-Object System.Drawing.Bitmap($cropW, $cropH, [System.Drawing.Imaging.PixelFormat]::Format32bppArgb)
$graphics = [System.Drawing.Graphics]::FromImage($croppedBmp)
$graphics.InterpolationMode = [System.Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
$graphics.DrawImage($src, (New-Object System.Drawing.Rectangle(0, 0, $cropW, $cropH)), $cropRect, [System.Drawing.GraphicsUnit]::Pixel)

# Make dark background pixels transparent
# If R < 35 and G < 40 and B < 50, make transparent
$transparentBmp = New-Object System.Drawing.Bitmap($cropW, $cropH, [System.Drawing.Imaging.PixelFormat]::Format32bppArgb)
for ($x = 0; $x -lt $cropW; $x++) {
    for ($y = 0; $y -lt $cropH; $y++) {
        $c = $croppedBmp.GetPixel($x, $y)
        # Background threshold
        if ($c.R -lt 30 -and $c.G -lt 35 -and $c.B -lt 45) {
            $transparentBmp.SetPixel($x, $y, [System.Drawing.Color]::FromArgb(0, 0, 0, 0))
        } else {
            $transparentBmp.SetPixel($x, $y, $c)
        }
    }
}

$transparentBmp.Save('public\images\logo.png', [System.Drawing.Imaging.ImageFormat]::Png)
$transparentBmp.Save('public\images\logo-emblem.png', [System.Drawing.Imaging.ImageFormat]::Png)
$transparentBmp.Save('public\logo.png', [System.Drawing.Imaging.ImageFormat]::Png)

$graphics.Dispose()
$croppedBmp.Dispose()
$transparentBmp.Dispose()
$src.Dispose()

Write-Output "Created transparent shield emblem: $cropW x $cropH"
