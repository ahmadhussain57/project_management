<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Update Feature</title>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased">
    
    <!-- حاوية تتمركز في منتصف الشاشة -->
    <div class="min-h-screen flex flex-col items-center justify-center py-10 px-4">
        
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-bold text-slate-700">Update Feature</h2>
            <p class="text-slate-500 mt-1">Modify your project feature details below</p>
        </div>

        <form action="{{route('projects.features.update', [$project, $feature])}}" method="post"
            class="w-full max-w-lg bg-white shadow-xl rounded-2xl p-8 border border-slate-100">
            
            @csrf
            @method('PUT')
            <input type="hidden" name="project_id" value="{{$project->id}}">

            <!-- Name Field -->
            <div class="mb-5">
                <label for="name" class="block text-sm font-semibold text-slate-600 mb-2">Feature Name</label>
                <input type="text" name="name" placeholder="Enter feature name" value="{{$feature->name}}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
            </div>

            <!-- Description Field -->
            <div class="mb-5">
                <label for="description" class="block text-sm font-semibold text-slate-600 mb-2">Description</label>
                <textarea name="description" rows="4" placeholder="Describe the feature..."
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none">{{$feature->description}}</textarea>
            </div>

            <!-- Status Field -->
            <div class="mb-6">
                <label for="status" class="block text-sm font-semibold text-slate-600 mb-2">Status</label>
                <select name="status" id="status"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                    <option value="active" {{ $feature->status === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $feature->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Checkboxes (Grid Layout for better look) -->
            <div class="mb-8">
                <p class="block text-sm font-semibold text-slate-600 mb-3">Tech Stack Components</p>
                <div class="grid grid-cols-3 gap-4">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="frontend" value="1" {{ $feature->frontend === 1 ? 'checked' : '' }}
                            class="w-5 h-5 text-blue-600 rounded border-slate-300 focus:ring-blue-500">
                        <span class="text-slate-700">Frontend</span>
                    </label>

                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="backend" value="1" {{ $feature->backend === 1 ? 'checked' : '' }}
                            class="w-5 h-5 text-blue-600 rounded border-slate-300 focus:ring-blue-500">
                        <span class="text-slate-700">Backend</span>
                    </label>

                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="DB" value="1" {{ $feature->DB === 1 ? 'checked' : '' }}
                            class="w-5 h-5 text-blue-600 rounded border-slate-300 focus:ring-blue-500">
                        <span class="text-slate-700">Database</span>
                    </label>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-slate-100">
                <a href="{{route('projects.show', $project->id)}}" 
                    class="text-slate-500 hover:text-slate-700 font-medium transition-colors px-4 py-2">
                    Cancel
                </a>
                <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md shadow-blue-500/30 transition-all active:scale-95">
                    Save Changes
                </button>
            </div>

        </form>
    </div>
</body>
</html>