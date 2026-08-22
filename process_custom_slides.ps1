Add-Type -AssemblyName System.Drawing

$base = "C:\Users\sakak\.gemini\antigravity-ide\brain\a8888a79-63ce-48c2-8682-87889840ac36\.user_uploaded"
$outDir = "public\images\slides"

if (-not (Test-Path $outDir)) {
    New-Item -ItemType Directory -Path $outDir -Force | Out-Null
}

# 1. Valorant (Foto 1)
$srcVal = [System.Drawing.Image]::FromFile("$base\media_1787403291338.png")
$srcVal.Save("$outDir\slide-valorant.jpg", [System.Drawing.Imaging.ImageFormat]::Jpeg)
$srcVal.Dispose()
Write-Output "Processed Valorant (Foto 1)"

# 2. Mobile Legends (Foto 2)
$srcMl = [System.Drawing.Image]::FromFile("$base\media_1787403780703.jpg")
$srcMl.Save("$outDir\slide-mlbb.jpg", [System.Drawing.Imaging.ImageFormat]::Jpeg)
$srcMl.Dispose()
Write-Output "Processed Mobile Legends (Foto 2)"

# 3. Free Fire (Foto 3)
$srcFf = [System.Drawing.Image]::FromFile("$base\media_1787403890918.png")
$srcFf.Save("$outDir\slide-ff.jpg", [System.Drawing.Imaging.ImageFormat]::Jpeg)
$srcFf.Dispose()
Write-Output "Processed Free Fire (Foto 3)"

# 4. PUBG Mobile (Foto 4) -> Rotate 90 degrees clockwise so it is landscape
$srcPubg = [System.Drawing.Image]::FromFile("$base\media_1787403912138.jpg")
if ($srcPubg.Width -lt $srcPubg.Height) {
    # It is vertical, rotate 90 degrees clockwise
    $srcPubg.RotateFlip([System.Drawing.RotateFlipType]::Rotate90FlipNone)
}
$srcPubg.Save("$outDir\slide-pubg.jpg", [System.Drawing.Imaging.ImageFormat]::Jpeg)
$srcPubg.Dispose()
Write-Output "Processed PUBG Mobile (Foto 4 rotated)"

Get-ChildItem $outDir | Select-Object Name, Length
