<template>

    <Head :title="place.title" />
    <div class="py-16 bg-white">
        <article class="px-4 sm:px-6 lg:px-8">
            <div class="text-lg max-w-prose mx-auto">
                <h1>
                    <span
                        class="block text-base text-center text-indigo-600 font-semibold tracking-wide uppercase">Lieu</span>
                    <span
                        class="mt-2 block text-3xl text-center leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">{{
                                place.title
                        }}</span>
                </h1>
            </div>
            <div class="mt-6 prose prose-indigo prose-lg text-gray-500 mx-auto">
                <figure>
                    <img class="w-full rounded-lg" :src="'/uploads/images/places/' + place.pictures[0].image" alt="Image de {{ place.title }}" width="1310" height="873" />
                    <figcaption>Photo de {{ place.title }}</figcaption>
                </figure>
                <p v-html="place.description"></p>
            </div>
        </article>

        <div v-if="isConnected" class="flex items-start space-x-4 max-w-7xl mx-auto px-4 sm:px-6 mt-16">
            <div class="flex-shrink-0">
                <img class="inline-block h-10 w-10 rounded-full object-cover" :src="'/uploads/images/users/' + auth.user.avatar" alt="Avatar" />
            </div>
            <div class="min-w-0 flex-1">
                <form action="#" class="relative">
                    <div
                        class="border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
                        <label for="comment" class="sr-only">Ajouter un commentaire</label>
                        <textarea v-model="form.comment" rows="3" name="comment" id="comment"
                            class="block w-full py-3 border-0 resize-none focus:ring-0 sm:text-sm"
                            placeholder="Ajouter un commentaire..." />

                        <!-- Spacer element to match the height of the toolbar -->
                        <div class="py-2" aria-hidden="true">
                            <!-- Matches height of button in toolbar (1px border + 36px content height) -->
                            <div class="py-px">
                                <div class="h-9" />
                            </div>
                        </div>
                    </div>

                    <div class="absolute bottom-0 inset-x-0 pl-3 pr-2 py-2 flex justify-between">
                        <div class="flex items-center space-x-5">
                            <div class="flex items-center">
                                <button type="button"
                                    class="-m-2.5 w-10 h-10 rounded-full flex items-center justify-center text-gray-400 hover:text-gray-500">
                                    <PaperClipIcon class="h-5 w-5" aria-hidden="true" />
                                    <span class="sr-only">Ajouter un fichier</span>
                                </button>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script>
import Layout from '@/layouts/Front'
import { Head } from '@inertiajs/inertia-vue3'
import { PaperClipIcon } from '@heroicons/vue/solid'

export default {
    layout: Layout,
    components: {
        Head,
        PaperClipIcon
    },
    props: {
        auth: {
            type: Object
        },
        isConnected: Boolean,
        place: Object,
    },
    data() {
        return {
            form: {
                comment: null,
            }
        }
    }
}
</script>
