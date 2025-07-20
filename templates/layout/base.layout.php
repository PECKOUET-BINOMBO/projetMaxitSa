<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'MAXITSA' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="MAX.webp" type="image/x-icon">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'maxitsa-orange': '#FF6B35',
                        'maxitsa-dark': '#2D2D2D'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-maxitsa-orange rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-lg">
                        
                        <?= strtoupper(substr($user->getNom() ?? '', 0, 1)); ?></span>
                    </div>
                    <h1 class="text-xl font-semibold text-gray-800">Aperçu du compte</h1>
                </div>
               
            </div>
        </header>

        <div class="flex">
            <!-- Sidebar -->
            <aside class="w-16 bg-maxitsa-orange min-h-screen">
                <div class="flex flex-col items-center py-6 space-y-6">
                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                    </div>
                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/>
                        </svg>
                    </div>
                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414L2.586 7l3.707-3.707a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded flex items-center justify-center">
                            <a href='/logout' >
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011-1h6a1 1 0 011 1v14a1 1 0 01-1 1h-6a1 1 0 01-1-1V3zm2.293 7.707a1 1 0 00-1.414-1.414L9.586 11H14a2 2 0 110 4H8a2 2 0 01-2-2V9a2 2 0 012-2h4a2 2 0 012 2v3.414l2.293-2.293z" clip-rule="evenodd"/>
                        </svg>
                            </a>                    
                        
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-6">
                <?php echo $content ?>
            </main>
        </div>
    </div>
    
</body>
</html>
