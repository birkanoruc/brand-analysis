<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aanlysis Result Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
        }

        .card-header {
            background-color: #082464;
            color: white;
        }

        .cardSubTitle {
            background-color: #ed1c24;
            color: white;
        }
    </style>
    <script>
        function truncateText(text, maxLength) {
            return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
        }
    </script>
</head>

<body>

    <div class="container mt-2 mb-2">
        <div class="card">

            @if ($analysi->brand->logoUrl)
                <img src="{{ $analysi->brand->logoUrl }}" class="img-fluid m-4" style="max-height: 90px"
                    alt="{{ $analysi->name }}">
            @endif

            <h3 class="fw-bold text-center m-4">MEDYA ANALİZ RAPORU</h3>

            <h4 class="fw-bold text-center m-2">{{ $analysi->brand->name }}</h4>

            <h4 class="fw-bold text-center m-2">
                {{ \Carbon\Carbon::parse($analysi->analysisDate)->translatedFormat('F Y') }}
            </h4>

            <div class="card-header mt-4 mb-4">
                <h4 class="card-title mb-1 mt-1">GENEL KAPSAM</h4>
            </div>
            <div class="card-body">
                <p>Bu rapor Medya Takip Merkezi tarafından <strong>{{ $analysi->brand->name }}</strong> adına
                    hazırlanmış detaylı medya analiz raporudur.</p>
                <p>RAPOR DÖNEMİ:
                    <strong>{{ \Carbon\Carbon::parse($analysi->analysisDate)->translatedFormat('F Y') }}</strong>
                </p>
                <p>Rapor medya takip şirketinin üretim tarihine göre hazırlanmıştır.</p>
            </div>

            <div class="card-header mt-4 mb-4">
                <h4 class="card-title mb-1 mt-1">YÖNETİCİ ÖZETİ</h4>
            </div>
            <div class="card-body">
                <p>
                    <strong>{{ $analysi->brand->name }}</strong> Markası için
                    {{ \Carbon\Carbon::parse($analysi->analysisDate)->translatedFormat('F Y') }} döneminde;
                </p>
                @php
                    $totalAdet = 0;
                @endphp
                <p>
                    @foreach ($categories as $category)
                        @if (isset($datas[$category->name]))
                            {{ $category->name }} mecralarında
                            <strong>{{ number_format($datas[$category->name]['brands'][$analysi->brand->name]['adet'], 0, ',', '.') }}</strong>
                            adet yansıma tespit edilmiştir.
                            @php
                                $totalAdet += $datas[$category->name]['brands'][$analysi->brand->name]['adet'];
                            @endphp
                        @endif
                    @endforeach
                    Toplam medyaya yansıma sayısı <strong>{{ number_format($totalAdet, 0, ',', '.') }}</strong>
                    adettir.
                </p>
                @php
                    $totalErisim = 0;
                @endphp
                <p>
                    Bu veriler
                    @foreach ($categories as $category)
                        @if (isset($datas[$category->name]))
                            {{ $category->name }} mecralarında
                            <strong>{{ number_format($datas[$category->name]['brands'][$analysi->brand->name]['erisim'], 0, ',', '.') }}</strong>
                            kişiye erişmiştir.
                            @php
                                $totalErisim += $datas[$category->name]['brands'][$analysi->brand->name]['erisim'];
                            @endphp
                        @endif
                    @endforeach
                    Toplamda ise <strong>{{ number_format($totalErisim, 0, ',', '.') }}</strong> kişiye
                    erişmiştir.
                </p>
                @php
                    $totalReesTry = 0;
                @endphp
                <p>
                    Yine aynı dönemde yansımalar
                    @foreach ($categories as $category)
                        @if (isset($datas[$category->name]))
                            {{ $category->name }} mecralarında
                            <strong>{{ number_format($datas[$category->name]['brands'][$analysi->brand->name]['rees_try'], 0, ',', '.') }}</strong>
                            TL reklam eşdeğeri sağlanmıştır.
                            @php
                                $totalReesTry += $datas[$category->name]['brands'][$analysi->brand->name]['rees_try'];
                            @endphp
                        @endif
                    @endforeach
                    Toplamda
                    <strong>{{ number_format($totalReesTry, 0, ',', '.') }}</strong>
                    TL reklam eşdeğeri sağlanmıştır.
                </p>
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th scope="col" style="color: #ed1c24">{{ $analysi->brand->name }}</th>
                            <th scope="col">Adet</th>
                            <th scope="col">Erişim</th>
                            <th scope="col">Re.Eş. (TRY)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            @if (isset($datas[$category->name]))
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ number_format($datas[$category->name]['brands'][$analysi->brand->name]['adet'], 0, ',', '.') }}
                                    </td>
                                    <td>{{ number_format($datas[$category->name]['brands'][$analysi->brand->name]['erisim'], 0, ',', '.') }}
                                    </td>
                                    <td>{{ number_format($datas[$category->name]['brands'][$analysi->brand->name]['rees_try'], 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td><strong>TOPLAM</strong></td>
                            <td><strong>{{ number_format($totalAdet, 0, ',', '.') }}</strong>
                            </td>
                            <td><strong>{{ number_format($totalErisim, 0, ',', '.') }}</strong>
                            </td>
                            <td><strong>{{ number_format($totalReesTry, 0, ',', '.') }}</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @foreach ($datas as $categoryName => $data)
                <div class="card-header mt-4 mb-4">
                    <h4 class="card-title mb-1 mt-1">{{ mb_strtoupper($categoryName, 'UTF-8') }}</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Sıra</th>
                                <th scope="col">Marka</th>
                                @if ($data['totals']['adet'] != 0)
                                    <th scope="col">Adet</th>
                                @endif
                                @if ($data['totals']['erisim'] != 0)
                                    <th scope="col">Erişim</th>
                                @endif
                                @if ($data['totals']['rees_try'] != 0)
                                    <th scope="col">Re.Eş. (TRY)</th>
                                @endif
                                @if ($data['totals']['stxcm'] != 0)
                                    <th scope="col">StxCm</th>
                                @endif
                                @if ($data['totals']['sure'] != 0)
                                    <th scope="col">Süre</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($data['brands']))
                                @php
                                    $sortedBrands = collect($data['brands'])->sortByDesc(function ($item) {
                                        return $item['adet'] ?? 0; // 'adet' değeri yoksa 0 kullan
                                    });
                                @endphp

                                @foreach ($sortedBrands as $brand => $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $brand }}</td>
                                        @if ($data['totals']['adet'] != 0)
                                            <td>{{ isset($item['adet']) ? number_format($item['adet'], 0, ',', '.') : 'N/A' }}
                                            </td>
                                        @endif
                                        @if ($data['totals']['erisim'] != 0)
                                            <td>{{ isset($item['erisim']) ? number_format($item['erisim'], 0, ',', '.') : 'N/A' }}
                                            </td>
                                        @endif
                                        @if ($data['totals']['rees_try'] != 0)
                                            <td>{{ isset($item['rees_try']) ? number_format($item['rees_try'], 2, ',', '.') : 'N/A' }}
                                            </td>
                                        @endif
                                        @if ($data['totals']['stxcm'] != 0)
                                            <td>{{ isset($item['stxcm']) ? number_format($item['stxcm'], 2, ',', '.') : 'N/A' }}
                                            </td>
                                        @endif
                                        @if ($data['totals']['sure'] != 0)
                                            <td>{{ isset($item['sure']) ? number_format($item['sure'], 2, ',', '.') : 'N/A' }}
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                            @if (isset($data['totals']))
                                <tr>
                                    <td colspan="2"><strong>TOPLAM</strong></td>
                                    @if ($data['totals']['adet'] != 0)
                                        <td><strong>{{ isset($data['totals']['adet']) ? number_format($data['totals']['adet'], 0, ',', '.') : 'N/A' }}</strong>
                                        </td>
                                    @endif
                                    @if ($data['totals']['erisim'] != 0)
                                        <td><strong>{{ isset($data['totals']['erisim']) ? number_format($data['totals']['erisim'], 0, ',', '.') : 'N/A' }}</strong>
                                        </td>
                                    @endif
                                    @if ($data['totals']['rees_try'] != 0)
                                        <td><strong>{{ isset($data['totals']['rees_try']) ? number_format($data['totals']['rees_try'], 2, ',', '.') : 'N/A' }}</strong>
                                        </td>
                                    @endif
                                    @if ($data['totals']['stxcm'] != 0)
                                        <td><strong>{{ isset($data['totals']['stxcm']) ? number_format($data['totals']['stxcm'], 2, ',', '.') : 'N/A' }}</strong>
                                        </td>
                                    @endif
                                    @if ($data['totals']['sure'] != 0)
                                        <td><strong>{{ isset($data['totals']['sure']) ? number_format($data['totals']['sure'], 2, ',', '.') : 'N/A' }}</strong>
                                        </td>
                                    @endif
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <div class="row m-0">
                        <div class="card-header cardSubTitle">
                            <h5 class="card-title mb-1 mt-1">{{ $categoryName }} - Grafik Dağılımı</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if ($data['totals']['adet'] != 0)
                                    <div class="col-md-6">
                                        <div id="{{ Str::slug($categoryName, '_') }}_adet"
                                            style="width:100%; max-width:1200px; min-height:{{ max(500, count($data['brands']) * 30) }}px;">
                                        </div>
                                    </div>

                                    <script>
                                        google.charts.load('current', {
                                            'packages': ['corechart']
                                        });
                                        google.charts.setOnLoadCallback(drawChartAdet{{ Str::slug($categoryName, '_') }});

                                        function drawChartAdet{{ Str::slug($categoryName, '_') }}() {
                                            const data = google.visualization.arrayToDataTable([
                                                ['Marka', 'Adet', {
                                                    role: 'annotation'
                                                }, {
                                                    role: 'style'
                                                }],
                                                @foreach ($data['brands'] as $brand => $item)
                                                    ['' + truncateText('{{ $brand }}', 15), {{ $item['adet'] ?? 0 }},
                                                        '{{ number_format($item['adet'] ?? 0, 0, ',', '.') }}',
                                                        @if ($brand === $analysi->brand->name)
                                                            '#ed1c24' // Eğer marka $analysi->brand->name ile eşleşiyorsa kırmızı renk uygula
                                                        @else
                                                            null // Diğer markalar için varsayılan renk kullan
                                                        @endif
                                                    ],
                                                @endforeach
                                            ]);

                                            // Verileri büyükten küçüğe sırala
                                            data.sort([{
                                                column: 1,
                                                desc: true
                                            }]);

                                            // NumberFormat sınıfı ile sayıları formatla
                                            const formatter = new google.visualization.NumberFormat({
                                                fractionDigits: 0, // Ondalık basamakları kaldır
                                                groupingSymbol: '.', // Binlik ayracı
                                                decimalSymbol: ',' // Ondalık ayracı
                                            });

                                            // İkinci kolon olan 'Adet' sütununu formatla
                                            formatter.format(data, 1);

                                            const options = {
                                                title: 'Haber Adedi - {{ $categoryName }}',
                                                annotations: {
                                                    alwaysOutside: true,
                                                    textStyle: {
                                                        fontSize: 12,
                                                        color: '#000',
                                                        auraColor: 'none'
                                                    }
                                                },
                                                chartArea: {
                                                    width: '50%',
                                                    height: '80%' // Grafiğin alanı
                                                },
                                                hAxis: {
                                                    minValue: 0,
                                                    textStyle: {
                                                        fontSize: 12 // X eksen yazı tipi boyutu
                                                    }
                                                },
                                                vAxis: {
                                                    textStyle: {
                                                        fontSize: 12 // Y eksen yazı tipi boyutu
                                                    }
                                                },
                                                legend: {
                                                    position: 'none'
                                                }
                                            };

                                            const chart = new google.visualization.BarChart(document.getElementById(
                                                '{{ Str::slug($categoryName, '_') }}_adet'));
                                            chart.draw(data, options);
                                        }
                                    </script>
                                @endif

                                @if ($data['totals']['erisim'] != 0)
                                    <div class="col-md-6">
                                        <div id="{{ Str::slug($categoryName, '_') }}_erisim"
                                            style="width:100%; max-width:1200px; min-height:{{ max(500, count($data['brands']) * 30) }}px;">
                                        </div>
                                    </div>
                                    <script>
                                        google.charts.load('current', {
                                            'packages': ['corechart']
                                        });
                                        google.charts.setOnLoadCallback(drawChartErisim{{ Str::slug($categoryName, '_') }});

                                        function drawChartErisim{{ Str::slug($categoryName, '_') }}() {
                                            const data = google.visualization.arrayToDataTable([
                                                ['Marka', 'Erişim', {
                                                    role: 'annotation'
                                                }, {
                                                    role: 'style'
                                                }], // Renk stili için role ekleniyor
                                                @foreach ($data['brands'] as $brand => $item)
                                                    ['' + truncateText('{{ $brand }}', 15), {{ $item['erisim'] ?? 0 }},
                                                        '{{ number_format($item['erisim'] ?? 0, 0, ',', '.') }}',
                                                        @if ($brand === $analysi->brand->name)
                                                            '#ed1c24' // Eğer marka $analysi->brand->name ile eşleşiyorsa kırmızı renk uygula
                                                        @else
                                                            null // Diğer markalar için varsayılan renk kullan
                                                        @endif
                                                    ],
                                                @endforeach
                                            ]);

                                            // Verileri büyükten küçüğe sırala
                                            data.sort([{
                                                column: 1,
                                                desc: true
                                            }]);

                                            // NumberFormat sınıfı ile sayıları formatla
                                            const formatter = new google.visualization.NumberFormat({
                                                fractionDigits: 0, // Ondalık basamakları kaldır
                                                groupingSymbol: '.', // Binlik ayracı
                                                decimalSymbol: ',' // Ondalık ayracı
                                            });

                                            // İkinci kolon olan 'Erişim' sütununu formatla
                                            formatter.format(data, 1);

                                            const options = {
                                                title: 'Erişim - {{ $categoryName }}',
                                                annotations: {
                                                    alwaysOutside: true,
                                                    textStyle: {
                                                        fontSize: 12,
                                                        color: '#000',
                                                        auraColor: 'none'
                                                    }
                                                },
                                                chartArea: {
                                                    width: '50%',
                                                    height: '80%' // Grafiğin alanı
                                                },
                                                hAxis: {
                                                    minValue: 0,
                                                    textStyle: {
                                                        fontSize: 12 // X eksen yazı tipi boyutu
                                                    }
                                                },
                                                vAxis: {
                                                    textStyle: {
                                                        fontSize: 12 // Y eksen yazı tipi boyutu
                                                    }
                                                },
                                                legend: {
                                                    position: 'none'
                                                } // Legend kısmını kaldır
                                            };

                                            const chart = new google.visualization.BarChart(document.getElementById(
                                                '{{ Str::slug($categoryName, '_') }}_erisim'));
                                            chart.draw(data, options);
                                        }
                                    </script>
                                @endif

                                @if ($data['totals']['rees_try'] != 0)
                                    <div class="col-md-6">
                                        <div id="{{ Str::slug($categoryName, '_') }}_rees_try"
                                            style="width:100%; max-width:1200px; min-height:{{ max(500, count($data['brands']) * 30) }}px;">
                                        </div>
                                    </div>
                                    <script>
                                        google.charts.load('current', {
                                            'packages': ['corechart']
                                        });
                                        google.charts.setOnLoadCallback(drawChartReesTry{{ Str::slug($categoryName, '_') }});

                                        function drawChartReesTry{{ Str::slug($categoryName, '_') }}() {
                                            const data = google.visualization.arrayToDataTable([
                                                ['Marka', 'Reklam Eş Değeri (TRY)', {
                                                    role: 'annotation'
                                                }, {
                                                    role: 'style'
                                                }], // Renk stili için role ekleniyor
                                                @foreach ($data['brands'] as $brand => $item)
                                                    ['' + truncateText('{{ $brand }}', 15), {{ $item['rees_try'] ?? 0 }},
                                                        '{{ number_format($item['rees_try'] ?? 0, 0, ',', '.') }}',
                                                        @if ($brand === $analysi->brand->name)
                                                            '#ed1c24' // Eğer marka $analysi->brand->name ile eşleşiyorsa kırmızı renk uygula
                                                        @else
                                                            null // Diğer markalar için varsayılan renk kullan
                                                        @endif
                                                    ],
                                                @endforeach
                                            ]);

                                            // Verileri büyükten küçüğe sırala
                                            data.sort([{
                                                column: 1,
                                                desc: true
                                            }]);

                                            // NumberFormat sınıfı ile sayıları formatla
                                            const formatter = new google.visualization.NumberFormat({
                                                fractionDigits: 0, // Ondalık basamakları kaldır
                                                groupingSymbol: '.', // Binlik ayracı
                                                decimalSymbol: ',' // Ondalık ayracı
                                            });

                                            // İkinci kolon olan 'Reklam Eş Değeri (TRY)' sütununu formatla
                                            formatter.format(data, 1);

                                            const options = {
                                                title: 'Reklam Eş Değeri (TRY) - {{ $categoryName }}',
                                                annotations: {
                                                    alwaysOutside: true,
                                                    textStyle: {
                                                        fontSize: 12,
                                                        color: '#000',
                                                        auraColor: 'none'
                                                    }
                                                },
                                                chartArea: {
                                                    width: '50%',
                                                    height: '80%' // Grafiğin alanı
                                                },
                                                hAxis: {
                                                    minValue: 0,
                                                    textStyle: {
                                                        fontSize: 12 // X eksen yazı tipi boyutu
                                                    }
                                                },
                                                vAxis: {
                                                    textStyle: {
                                                        fontSize: 12 // Y eksen yazı tipi boyutu
                                                    }
                                                },
                                                legend: {
                                                    position: 'none'
                                                } // Legend kısmını kaldır
                                            };

                                            const chart = new google.visualization.BarChart(document.getElementById(
                                                '{{ Str::slug($categoryName, '_') }}_rees_try'));
                                            chart.draw(data, options);
                                        }
                                    </script>
                                @endif

                                @if ($data['totals']['stxcm'] != 0)
                                    <div class="col-md-6">
                                        <div id="{{ Str::slug($categoryName, '_') }}_stxcm"
                                            style="width:100%; max-width:1200px; min-height:{{ max(500, count($data['brands']) * 30) }}px;">
                                        </div>
                                    </div>
                                    <script>
                                        google.charts.load('current', {
                                            'packages': ['corechart']
                                        });
                                        google.charts.setOnLoadCallback(drawChartStxcm{{ Str::slug($categoryName, '_') }});

                                        function drawChartStxcm{{ Str::slug($categoryName, '_') }}() {
                                            const data = google.visualization.arrayToDataTable([
                                                ['Marka', 'StxCm', {
                                                    role: 'annotation'
                                                }, {
                                                    role: 'style'
                                                }], // Renk stili için role ekleniyor
                                                @foreach ($data['brands'] as $brand => $item)
                                                    ['' + truncateText('{{ $brand }}', 15), {{ $item['stxcm'] ?? 0 }},
                                                        '{{ number_format($item['stxcm'] ?? 0, 0, ',', '.') }}',
                                                        @if ($brand === $analysi->brand->name)
                                                            '#ed1c24' // Eğer marka $analysi->brand->name ile eşleşiyorsa kırmızı renk uygula
                                                        @else
                                                            null // Diğer markalar için varsayılan renk kullan
                                                        @endif
                                                    ],
                                                @endforeach
                                            ]);

                                            // Verileri büyükten küçüğe sırala
                                            data.sort([{
                                                column: 1,
                                                desc: true
                                            }]);

                                            // NumberFormat sınıfı ile sayıları formatla
                                            const formatter = new google.visualization.NumberFormat({
                                                fractionDigits: 0, // Ondalık basamakları kaldır
                                                groupingSymbol: '.', // Binlik ayracı
                                                decimalSymbol: ',' // Ondalık ayracı
                                            });

                                            // İkinci kolon olan 'StxCm' sütununu formatla
                                            formatter.format(data, 1);

                                            const options = {
                                                title: 'StxCm - {{ $categoryName }}',
                                                annotations: {
                                                    alwaysOutside: true,
                                                    textStyle: {
                                                        fontSize: 12,
                                                        color: '#000',
                                                        auraColor: 'none'
                                                    }
                                                },
                                                chartArea: {
                                                    width: '50%',
                                                    height: '80%' // Grafiğin alanı
                                                },
                                                hAxis: {
                                                    minValue: 0,
                                                    textStyle: {
                                                        fontSize: 12 // X eksen yazı tipi boyutu
                                                    }
                                                },
                                                vAxis: {
                                                    textStyle: {
                                                        fontSize: 12 // Y eksen yazı tipi boyutu
                                                    }
                                                },
                                                legend: {
                                                    position: 'none'
                                                } // Legend kısmını kaldır
                                            };

                                            const chart = new google.visualization.BarChart(document.getElementById(
                                                '{{ Str::slug($categoryName, '_') }}_stxcm'));
                                            chart.draw(data, options);
                                        }
                                    </script>
                                @endif

                                @if ($data['totals']['sure'] != 0)
                                    <div class="col-md-6">
                                        <div id="{{ Str::slug($categoryName, '_') }}_sure"
                                            style="width:100%; max-width:1200px; min-height:{{ max(500, count($data['brands']) * 30) }}px;">
                                        </div>
                                    </div>
                                    <script>
                                        google.charts.load('current', {
                                            'packages': ['corechart']
                                        });
                                        google.charts.setOnLoadCallback(drawChartSure{{ Str::slug($categoryName, '_') }});

                                        function drawChartSure{{ Str::slug($categoryName, '_') }}() {
                                            const data = google.visualization.arrayToDataTable([
                                                ['Marka', 'Süre', {
                                                    role: 'annotation'
                                                }, {
                                                    role: 'style'
                                                }], // Renk stili için role ekleniyor
                                                @foreach ($data['brands'] as $brand => $item)
                                                    ['' + truncateText('{{ $brand }}', 15), {{ $item['sure'] ?? 0 }},
                                                        '{{ number_format($item['sure'] ?? 0, 0, ',', '.') }}',
                                                        @if ($brand === $analysi->brand->name)
                                                            '#ed1c24' // Eğer marka $analysi->brand->name ile eşleşiyorsa kırmızı renk uygula
                                                        @else
                                                            null // Diğer markalar için varsayılan renk kullan
                                                        @endif
                                                    ],
                                                @endforeach
                                            ]);

                                            // Verileri büyükten küçüğe sırala
                                            data.sort([{
                                                column: 1,
                                                desc: true
                                            }]);

                                            // NumberFormat sınıfı ile sayıları formatla
                                            const formatter = new google.visualization.NumberFormat({
                                                fractionDigits: 0, // Ondalık basamakları kaldır
                                                groupingSymbol: '.', // Binlik ayracı
                                                decimalSymbol: ',' // Ondalık ayracı
                                            });

                                            // İkinci kolon olan 'Süre' sütununu formatla
                                            formatter.format(data, 1);

                                            const options = {
                                                title: 'Süre - {{ $categoryName }}',
                                                annotations: {
                                                    alwaysOutside: true,
                                                    textStyle: {
                                                        fontSize: 12,
                                                        color: '#000',
                                                        auraColor: 'none'
                                                    }
                                                },
                                                chartArea: {
                                                    width: '50%',
                                                    height: '80%' // Grafiğin alanı
                                                },
                                                hAxis: {
                                                    minValue: 0,
                                                    textStyle: {
                                                        fontSize: 12 // X eksen yazı tipi boyutu
                                                    }
                                                },
                                                vAxis: {
                                                    textStyle: {
                                                        fontSize: 12 // Y eksen yazı tipi boyutu
                                                    }
                                                },
                                                legend: {
                                                    position: 'none'
                                                } // Legend kısmını kaldır
                                            };

                                            const chart = new google.visualization.BarChart(document.getElementById(
                                                '{{ Str::slug($categoryName, '_') }}_sure'));
                                            chart.draw(data, options);
                                        }
                                    </script>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
