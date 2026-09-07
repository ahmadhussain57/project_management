@php
    /** @var \App\Models\Project $project */
    /** @var \App\Models\Feature $feature */
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $project->name }} - Details</title>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased min-h-screen">

    <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <!-- Navigation / Back Button -->
        <div class="mb-6">
            <a href="{{ route('projects.index') }}" 
                class="inline-flex items-center text-slate-500 hover:text-slate-700 font-medium transition-colors text-sm">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Projects
            </a>
        </div>

        <!-- Project Overview Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8 mb-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800">{{ $project->name }}</h1>
                    
                    <!-- Dates Badges -->
                    <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500 mt-2">
                        <span class="bg-slate-100 px-3 py-1 rounded-lg">
                            <strong class="text-slate-700">Start:</strong> {{ $project->start_date ?? 'N/A' }}
                        </span>
                        <span class="bg-slate-100 px-3 py-1 rounded-lg">
                            <strong class="text-slate-700">End:</strong> {{ $project->end_date ?? 'N/A' }}
                        </span>
                    </div>
                </div>

                <!-- Project Actions -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('projects.edit', $project->id) }}" 
                        class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-2 px-4 rounded-xl transition-colors text-sm">
                        Edit
                    </a>
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" 
                        onsubmit="return confirm('Are you sure you want to delete this project?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            class="bg-rose-50 hover:bg-rose-100 text-rose-600 font-semibold py-2 px-4 rounded-xl transition-colors text-sm">
                            Delete Project
                        </button>
                    </form>
                </div>
            </div>

            <!-- Description -->
            <div class="border-t border-slate-100 pt-4">
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Description</h3>
                <p class="text-slate-600 leading-relaxed">{{ $project->description }}</p>
            </div>
        </div>

        <!-- Features Header & Create Button -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Features</h2>
                <p class="text-slate-500 text-sm">Features developed for this project</p>
            </div>
            <a href="{{ route('projects.features.create', $project->id) }}" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-xl shadow-md shadow-blue-500/20 transition-all active:scale-95 text-sm flex items-center space-x-1">
                <span>+ Create Feature</span>
            </a>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse ($project->features as $feature)
            <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-6 flex flex-col justify-between hover:shadow-lg transition-shadow">
                <div>
                    <!-- Feature Header -->
                    <div class="flex items-start justify-between gap-2 mb-3">
                        <h3 class="text-lg font-bold text-slate-800">{{ $feature->name }}</h3>
                        <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full capitalize {{ $feature->status == 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                            {{ $feature->status }}
                        </span>
                    </div>

                    <p class="text-slate-600 text-sm mb-5 line-clamp-2">{{ $feature->description }}</p>

                    <!-- Tech Components Badges -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="px-3 py-1 rounded-lg text-xs font-semibold {{ $feature->frontend === 1 ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-slate-100 text-slate-400' }}">
                            Frontend: {{ $feature->frontend === 1 ? 'Done' : 'Pending' }}
                        </span>
                        <span class="px-3 py-1 rounded-lg text-xs font-semibold {{ $feature->backend === 1 ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-slate-100 text-slate-400' }}">
                            Backend: {{ $feature->backend === 1 ? 'Done' : 'Pending' }}
                        </span>
                        <span class="px-3 py-1 rounded-lg text-xs font-semibold {{ $feature->DB === 1 ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-slate-100 text-slate-400' }}">
                            Database: {{ $feature->DB === 1 ? 'Done' : 'Pending' }}
                        </span>
                    </div>
                </div>

                <!-- Action Link -->
                <div class="pt-4 border-t border-slate-100 flex justify-end">
                    <a href="{{ route('projects.features.show', [$project, $feature]) }}" 
                        class="text-blue-600 hover:text-blue-700 font-semibold text-sm inline-flex items-center space-x-1">
                        <span>View Details</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full bg-white rounded-2xl p-8 text-center border border-slate-100 shadow-sm">
                <p class="text-slate-500 font-medium">No features added to this project yet.</p>
            </div>
            @endforelse
        </div>

    </div>

</body>
</html>