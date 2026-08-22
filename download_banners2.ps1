$urls = @(
    @{ Name = "slide-valorant.jpg"; Url = "https://images4.alphacoders.com/108/1083431.jpg" },
    @{ Name = "slide-genshin.jpg"; Url = "https://images8.alphacoders.com/112/1126938.jpg" }
)

$wc = New-Object System.Net.WebClient
$wc.Headers.Add("User-Agent", "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36")

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
