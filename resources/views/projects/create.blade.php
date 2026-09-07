<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Create Project</title>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased">

    <div class="min-h-screen flex flex-col items-center justify-center py-10 px-4">

        <!-- Title Section -->
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-bold text-slate-700">Create New Project</h2>
            <p class="text-slate-500 mt-1">Fill in the details below to start a new project</p>
        </div>

        <!-- Error Alert (If Any) -->
        @if ($errors->any())
        <div class="w-full max-w-xl bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6 shadow-sm">
            <p class="font-semibold mb-1">Please fix the following errors:</p>
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Form Card -->
        <form action="{{route('projects.store')}}" method="post"
            class="w-full max-w-xl bg-white shadow-xl rounded-2xl p-8 border border-slate-100">
            
            @csrf

            <!-- Project Name -->
            <div class="mb-5">
                <label for="name" class="block text-sm font-semibold text-slate-600 mb-2">Project Name</label>
                <input type="text" name="name" id="name" placeholder="Enter project name" value="{{ old('name') }}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
            </div>

            <!-- Description -->
            <div class="mb-5">
                <label for="description" class="block text-sm font-semibold text-slate-600 mb-2">Description</label>
                <textarea name="description" id="description" rows="4" placeholder="Describe the project..."
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none">{{ old('description') }}</textarea>
            </div>

            <!-- Start Date & End Date (Side by Side) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                <div>
                    <label for="start_date" class="block text-sm font-semibold text-slate-600 mb-2">Start Date</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-slate-700">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-semibold text-slate-600 mb-2">End Date</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-slate-700">
                </div>
            </div>

            <!-- Status -->
            <div class="mb-8">
                <label for="status" class="block text-sm font-semibold text-slate-600 mb-2">Status</label>
                <select name="status" id="status"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Form Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-slate-100">
                <a href="{{ route('projects.index') }}" 
                    class="text-slate-500 hover:text-slate-700 font-medium transition-colors px-4 py-2">
                    Cancel
                </a>
                <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md shadow-blue-500/30 transition-all active:scale-95">
                    Create Project
                </button>
            </div>

        </form>
    </div>

</body>
</html>