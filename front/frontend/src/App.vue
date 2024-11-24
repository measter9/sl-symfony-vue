<template>
  <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
    <div class="w-full max-w-3xl bg-white rounded-lg shadow-xl">
      <div class="p-8">
        <h1 class="text-2xl font-semibold text-gray-700 text-center">Application Form</h1>
        <div class="mt-6">
          <div class="flex mb-4">
            <template v-for="(step, index) in steps" :key="index">
              <div
                class="flex-1 text-center"
                :class="{
                  'text-blue-600 font-medium': currentStep === index,
                  'text-gray-400': currentStep !== index
                }"
              >
                {{ step }}
              </div>
              <div v-if="index < steps.length - 1" class="flex-1 border-b-2 border-gray-200 my-auto"></div>
            </template>
          </div>

          <form @submit.prevent="submitForm">
            <PersonalInfo v-if="currentStep === 0" v-model="formData" />
            <ContactInfo v-if="currentStep === 1" v-model="formData" />
            <WorkExperience v-if="currentStep === 2" v-model="formData.experience" />

            <div class="mt-8 flex justify-between">
              <button
                v-if="currentStep > 0"
                @click="prevStep"
                type="button"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400"
              >
                Previous
              </button>
              <button
                v-if="currentStep < steps.length - 1"
                @click="nextStep"
                type="button"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
              >
                Next
              </button>
              <button
                v-if="currentStep === steps.length - 1"
                type="submit"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500"
              >
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import PersonalInfo from './PersonalInfo.vue'
import ContactInfo from './ContactInfo.vue'
import WorkExperience from './WorkExperience.vue'
import axios from 'axios'


const steps = ['Personal Information', 'Contact Information', 'Work Experience']
const currentStep = ref(0)

const formData = reactive({
  firstname: '',
  lastname: '',
  birthdate: '',
  phone: '',
  email: '',
  experience: []
})


const nextStep = () => {
  if (currentStep.value < steps.length - 1) {
    currentStep.value++
  }
}

const prevStep = () => {
  if (currentStep.value > 0) {
    currentStep.value--
  }
}

const submitForm = () => {
  // console.log('Form submitted:', JSON.stringify(formData, null, 2))
  axios.post("http://localhost:8000/user", 
    formData
  )
  .then(function (response) {
    console.log(response);
    alert(JSON.stringify(response.data, null, 2))
  })
  .catch(function (error) {
    console.log("error")
    console.log(error);
    alert(error.response.data)
  });
}
</script>

