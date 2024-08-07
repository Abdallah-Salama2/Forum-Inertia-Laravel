<script setup>
import ForumLayout from "@/Layouts/ForumLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import {Head} from '@inertiajs/vue3';
import Post from "@/Components/Forum/Post.vue";
import Discussion from "@/Components/Forum/Discussion.vue";
import pluralize from "pluralize";

defineProps({
    discussion: Object,
    posts: Object
})
</script>

<template>
    <Head :title="discussion.title"/>

    <ForumLayout>
        <!--  <template #side> it will detect the slot with name side-->

        <template #side>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Side
                </div>
            </div>
        </template>
        <!--  right in forumn layout-->
        <div class="space-y-3">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                    <span
                        class="inline-flex items-center rounded-lg bg-gray-100 px-3 py-0.5 text-sm text-gray-600">{{
                            discussion.topic.title
                        }}</span>
                        <h1 class="text-lg font-medium">
                            <template v-if="discussion.is_pinned">
                                [Pinned]
                            </template>
                            {{ discussion.title }}
                        </h1>
                    </div>
                    <div class="text-sm">
                        {{ pluralize('reply', discussion.replies_count, true) }}
                    </div>
                </div>
            </div>
            <template v-if="posts.data.length">
                <Post v-for="post in posts.data" :key="post.id" :post="post"/>
                <Pagination :pagination="posts.meta"/>
            </template>
        </div>
    </ForumLayout>
</template>
