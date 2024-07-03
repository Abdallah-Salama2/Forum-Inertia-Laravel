<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import ForumLayout from "@/Layouts/ForumLayout.vue";
import Select from "@/Components/Select.vue";
import InputLabel from "@/Components/InputLabel.vue";

</script>

<template>
    <Head title="Dashboard"/>

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
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div>
                    <InputLabel for="topic" class="sr-only ">Topic</InputLabel>
                    <Select id="topic">
                        <option value="">All topics</option>
                        <option :value="topic.slug" v-for="topic in $page.props.topics" :key="topic.id">
                            {{ topic.name }}
                        </option>
                    </Select>
                </div>
            </div>
        </div>
    </ForumLayout>
</template>
