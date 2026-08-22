$urls = @(
    @{ Name = "slide-mlbb.jpg"; Url = "https://wallpapercave.com/wp/wp8887169.jpg" },
    @{ Name = "slide-ff.jpg"; Url = "https://wallpapercave.com/wp/wp7805128.jpg" },
    @{ Name = "slide-pubg.jpg"; Url = "https://wallpapercave.com/wp/wp4900762.jpg" },
    @{ Name = "slide-valorant.jpg"; Url = "https://wallpapercave.com/wp/wp6658098.jpg" }
)

if (-not (Test-Path 'public\images\slides')) {
    New-Item -ItemType Directory -Path 'public\images\slides' -Force | Out-Null
}

$wc = New-Object System.Net.WebClient
$wc.Headers.Add("User-Agent", "Mozilla/5.0 (Windows NT 10.0; Win64; x64)")

foreach ($item in $urls) {
    $out = "public\images\slides\" + $item.Name
    try {
        $wc.DownloadFile($item.Url, $out)
        Write-Output "Downloaded $($item.Name)"
    } catch {
        Write-Output "Fallback for $($item.Name)"
    }
}

Get-ChildItem 'public\images\slides' | Select-Object Name, Length
