$urls = @(
    @{ Name = "slide-valorant.jpg"; Url = "https://wallpapercave.com/wp/wp6658145.jpg" },
    @{ Name = "slide-genshin.jpg"; Url = "https://wallpapercave.com/wp/wp8066606.jpg" }
)

$wc = New-Object System.Net.WebClient
$wc.Headers.Add("User-Agent", "Mozilla/5.0 (Windows NT 10.0; Win64; x64)")

foreach ($item in $urls) {
    $out = "public\images\slides\" + $item.Name
    try {
        $wc.DownloadFile($item.Url, $out)
        Write-Output "Downloaded $($item.Name)"
    } catch {
        Write-Output "Failed $($item.Name)"
    }
}

Get-ChildItem 'public\images\slides' | Select-Object Name, Length
