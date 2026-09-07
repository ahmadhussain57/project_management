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
    <title>Feature - {{ $feature->name }}</title>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased min-h-screen">

    <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <!-- Navigation / Back Button -->
        <div class="mb-6">
            <a href="{{ route('projects.show', $project->id) }}" 
                class="inline-flex items-center text-slate-500 hover:text-slate-700 font-medium transition-colors text-sm">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Project
            </a>
        </div>

        <!-- Feature Main Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8">
            
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
                <div>
                    <span class="text-xs font-semibold text-blue-600 uppercase tracking-wider">Feature Details</span>
                    <h1 class="text-3xl font-bold text-slate-800 mt-1">{{ $feature->name }}</h1>
                </div>

                <!-- Status Badge -->
                <div>
                    <span class="px-3.5 py-1.5 text-xs font-semibold rounded-full capitalize inline-block {{ $feature->status == 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                        Status: {{ $feature->status }}
                    </span>
                </div>
            </div>

            <!-- Description Section -->
            <div class="py-6 border-b border-slate-100">
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Description</h3>
                <p class="text-slate-600 leading-relaxed">
                    {{ $feature->description ?: 'No description provided for this feature.' }}
                </p>
            </div>

            <!-- Tech Components Status Grid -->
            <div class="py-6 border-b border-slate-100">
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Components Status</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    
                    <!-- Frontend Badge Card -->
                    <div class="p-4 rounded-xl border {{ $feature->frontend === 1 ? 'bg-emerald-50/50 border-emerald-200' : 'bg-amber-50/50 border-amber-200' }} flex flex-col justify-between">
                        <span class="text-xs font-medium text-slate-500 mb-1">Frontend</span>
                        <span class="text-sm font-bold {{ $feature->frontend === 1 ? 'text-emerald-700' : 'text-amber-700' }}">
                            {{ $feature->frontend === 1 ? 'Completed' : 'Pending' }}
                        </span>
                    </div>

                    <!-- Backend Badge Card -->
                    <div class="p-4 rounded-xl border {{ $feature->backend === 1 ? 'bg-emerald-50/50 border-emerald-200' : 'bg-amber-50/50 border-amber-200' }} flex flex-col justify-between">
                        <span class="text-xs font-medium text-slate-500 mb-1">Backend</span>
                        <span class="text-sm font-bold {{ $feature->backend === 1 ? 'text-emerald-700' : 'text-amber-700' }}">
                            {{ $feature->backend === 1 ? 'Completed' : 'Pending' }}
                        </span>
                    </div>

                    <!-- Database Badge Card -->
                    <div class="p-4 rounded-xl border {{ $feature->DB === 1 ? 'bg-emerald-50/50 border-emerald-200' : 'bg-amber-50/50 border-amber-200' }} flex flex-col justify-between">
                        <span class="text-xs font-medium text-slate-500 mb-1">Database</span>
                        <span class="text-sm font-bold {{ $feature->DB === 1 ? 'text-emerald-700' : 'text-amber-700' }}">
                            {{ $feature->DB === 1 ? 'Completed' : 'Pending' }}
                        </span>
                    </div>

                </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-6 flex items-center justify-end space-x-3">
                <a href="{{ route('projects.features.edit', [$project, $feature]) }}" 
                    class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-2 px-5 rounded-xl transition-colors text-sm">
                    Edit Feature
                </a>

                <form action="{{ route('projects.features.destroy', [$project, $feature]) }}" method="post"
                    onsubmit="return confirm('Are you sure you want to delete this feature?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                        class="bg-rose-50 hover:bg-rose-100 text-rose-600 font-semibold py-2 px-5 rounded-xl transition-colors text-sm">
                        Delete Feature
                    </button>
                </form>
            </div>

        </div>

    </div>

</body>
</html>