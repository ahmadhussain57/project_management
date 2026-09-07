<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Projects</title>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased min-h-screen">

    <div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">Projects</h1>
                <p class="text-slate-500 text-sm mt-1">Manage and monitor all your projects</p>
            </div>
            <a href="{{ route('projects.create') }}" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-5 rounded-xl shadow-md shadow-blue-500/20 transition-all active:scale-95 flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Create Project</span>
            </a>
        </div>

        <!-- Error Alert -->
        @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6 shadow-sm">
            <p class="font-semibold mb-1">Please fix the following errors:</p>
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Projects Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($projects as $project)
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all border border-slate-100 p-6 flex flex-col justify-between">
                <div>
                    <!-- Header Card: Title & Status Badge -->
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <h2 class="text-xl font-bold text-slate-800 line-clamp-1">{{ $project->name }}</h2>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full capitalize whitespace-nowrap {{ $project->status == 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                            {{ $project->status }}
                        </span>
                    </div>

                    <!-- Description -->
                    <p class="text-slate-600 text-sm mb-6 line-clamp-3">
                        {{ $project->description }}
                    </p>
                </div>

                <!-- Footer Card: Action Button -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end">
                    <a href="{{ route('projects.show', $project->id) }}" 
                        class="bg-slate-100 hover:bg-blue-50 text-slate-700 hover:text-blue-600 font-semibold text-sm px-4 py-2 rounded-lg transition-colors inline-flex items-center space-x-1">
                        <span>View Details</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full bg-white rounded-2xl p-12 text-center border border-slate-100 shadow-sm">
                <p class="text-slate-500 font-medium">No projects found.</p>
                <a href="{{ route('projects.create') }}" class="text-blue-600 hover:underline text-sm font-semibold mt-2 inline-block">Create your first project</a>
            </div>
            @endforelse
        </div>

    </div>

</body>
</html>