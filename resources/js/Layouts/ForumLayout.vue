<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12 max-w-7xl mx-auto space-y-6 md:space-y-0 md:grid grid-cols-7 gap-6 sm:px-6 lg:px-8">
            <div class="col-span-2 "> <slot name="side"/> </div>
            <div class="col-span-5 "> <slot/> </div>
<!--            col span 5 means width of right bigger than col span 2 of left-->
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
