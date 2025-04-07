<div>

    <div id="addModuleModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-6xl max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-accent-dark">Add New Module For {{ $course->title }} Course</h2>
                <button onclick="closeAddModuleModal()" class="text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form class="p-6 space-y-6" action="{{ route('store_module', $course->id) }}" method="post">
                @csrf
                <div class="pt-6">
                    <h3 class="text-lg font-medium text-accent-dark mb-4">Course Modules</h3>
                    <div id="modules-container" class="space-y-4">
                        <!-- Modules will be added here dynamically -->
                        @if ($modules->count())
                            @foreach ($modules as $module)
                                <div class="p-4 border border-gray-200 rounded-lg bg-white">
                                    <div class="flex justify-between items-center mb-4">
                                        <h4 class="text-md font-medium text-gray-800">Module<span
                                                class="module-number">{{ "  $module->module_number" }}</span></h4>
                                        <button type="button" onclick="deleteModule(this)"
                                            data-url="{{ route('delete_module', $module->id) }}"
                                            class="text-red-600 hover:text-red-800 text-sm flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Delete
                                        </button>
                                    </div>

                                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Module Title*</label>
                                            <input type="text"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50"
                                                placeholder="{{ $module->title }}" disabled>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Module
                                            Description*</label>
                                        <textarea name="module_content[]" rows="3"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50"
                                            placeholder='{{ $module->content }}' disabled></textarea>
                                    </div>

                                    <!-- Module Quiz Section -->
                                    @if ($module->quiz_questions->count())
                                        <div class="flex justify-between items-center mb-4">
                                            <h5 class="text-md font-medium text-gray-700">
                                                {{ "$module->title Quiz" }}</h5>
                                        </div>
                                        @foreach ($module->quiz_questions as $index => $quiz)
                                            <div class="module-quiz bg-gray-50 p-4 rounded-lg">

                                                <div class="space-y-4">

                                                    <div
                                                        class="question-item p-4 border border-gray-200 rounded-lg bg-white">
                                                        <div class="flex justify-between items-center mb-3">
                                                            <h6 class="text-sm font-medium text-gray-700">Question {{ ++$index }}<span
                                                                    class="question-number"></span></h6>
                                                            <button type="button"
                                                                class="remove-question text-red-600 hover:text-red-800 text-xs flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="h-3 w-3 mr-1" viewBox="0 0 20 20"
                                                                    fill="currentColor">
                                                                    <path fill-rule="evenodd"
                                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                                Remove
                                                            </button>
                                                        </div>

                                                        <div class="mb-4">
                                                            <label
                                                                class="block text-sm font-medium text-gray-700">Question
                                                                Text*</label>
                                                            <input type="text" name="question_text[]"
                                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50"
                                                                placeholder="{{ $quiz->question_text }}" disabled>
                                                        </div>

                                                        <div class="grid md:grid-cols-2 gap-4">
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">Option
                                                                    A*</label>
                                                                <div class="flex items-center mt-1">
                                                                    <input type="text" name="option_a[]"
                                                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50"
                                                                        placeholder="{{ $quiz->option->option_a }}"
                                                                        disabled>
                                                                    <input type="checkbox" name="correct_option[]"
                                                                        {{ $quiz->option->correct_option == 'a' ? 'checked' : '' }}
                                                                        value="a"
                                                                        class="ml-2 h-4 w-4 text-primary focus:ring-primary"
                                                                        disabled>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">Option
                                                                    B*</label>
                                                                <div class="flex items-center mt-1">
                                                                    <input type="text" name="option_b[]"
                                                                        placeholder="{{ $quiz->option->option_b }}"
                                                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50"
                                                                        disabled>
                                                                    <input type="checkbox" name="correct_option[]"
                                                                        {{ $quiz->option->correct_option == 'b' ? 'checked' : '' }}
                                                                        value="b"
                                                                        class="ml-2 h-4 w-4 text-primary focus:ring-primary"
                                                                        disabled>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">Option
                                                                    C</label>
                                                                <div class="flex items-center mt-1">
                                                                    <input type="text" name="option_c[]"
                                                                        placeholder="{{ $quiz->option->option_c }}"
                                                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50"
                                                                        disabled>
                                                                    <input type="checkbox" name="correct_option[]"
                                                                        {{ $quiz->option->correct_option == 'c' ? 'checked' : '' }}
                                                                        value="c"
                                                                        class="ml-2 h-4 w-4 text-primary focus:ring-primary"
                                                                        disabled>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">Option
                                                                    D</label>
                                                                <div class="flex items-center mt-1">
                                                                    <input type="text" name="option_d[]"
                                                                        placeholder="{{ $quiz->option->option_d }}"
                                                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50"
                                                                        disabled>
                                                                    <input type="checkbox" name="correct_option[]"
                                                                        {{ $quiz->option->correct_option == 'd' ? 'checked' : '' }}
                                                                        value="d"
                                                                        class="ml-2 h-4 w-4 text-primary focus:ring-primary"
                                                                        disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach

                        @endif
                    </div>
                    <button type="button" id="add-module"
                        class="mt-4 text-sm text-primary hover:text-secondary flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Add Module
                    </button>
                </div>


                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <button type="button" onclick="closeAddModuleModal()"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-secondary">Add
                        Module</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Module Template (Hidden) -->
    <template id="module-template">
        <div class="module-item p-4 border border-gray-200 rounded-lg bg-white">
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-md font-medium text-gray-800">Module</h4>
                <button type="button"
                    class="remove-module text-red-600 hover:text-red-800 text-sm flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Remove
                </button>
            </div>

            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Module Title*</label>
                    <input type="text" name="module_title[]"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Module Number*</label>
                    <input type="number" name="module_number[]" min="1"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Module Description*</label>
                <textarea name="module_content[]" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50"></textarea>
            </div>

            <!-- Module Quiz Section -->
            <div class="module-quiz bg-gray-50 p-4 rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h5 class="text-md font-medium text-gray-700">Module Quiz</h5>
                </div>

                <div class="quiz-questions space-y-4">
                    <!-- Questions will be added here -->
                </div>

                <button type="button" onclick="addQuestion()"
                    class="add-question mt-4 text-sm text-primary hover:text-secondary flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add Question
                </button>
            </div>
        </div>
    </template>

    <!-- Question Template (Hidden) -->
    <template id="question-template">
        <div class="question-item p-4 border border-gray-200 rounded-lg bg-white">
            <div class="flex justify-between items-center mb-3">
                <h6 class="text-sm font-medium text-gray-700">Question <span class="question-number">1</span></h6>
                <button type="button"
                    class="remove-question text-red-600 hover:text-red-800 text-xs flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Remove
                </button>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Question Text*</label>
                <input type="text" name="question_text[]"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Option A*</label>
                    <div class="flex items-center mt-1">
                        <input type="text" name="option_a[]"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                        <input type="checkbox" name="correct_option[]" value="a"
                            class="ml-2 h-4 w-4 text-primary focus:ring-primary">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Option B*</label>
                    <div class="flex items-center mt-1">
                        <input type="text" name="option_b[]"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                        <input type="checkbox" name="correct_option[]" value="b"
                            class="ml-2 h-4 w-4 text-primary focus:ring-primary">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Option C</label>
                    <div class="flex items-center mt-1">
                        <input type="text" name="option_c[]"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                        <input type="checkbox" name="correct_option[]" value="c"
                            class="ml-2 h-4 w-4 text-primary focus:ring-primary">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Option D</label>
                    <div class="flex items-center mt-1">
                        <input type="text" name="option_d[]"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                        <input type="checkbox" name="correct_option[]" value="d"
                            class="ml-2 h-4 w-4 text-primary focus:ring-primary">
                    </div>
                </div>
            </div>
        </div>
    </template>


</div>
