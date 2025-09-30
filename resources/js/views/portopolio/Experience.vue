<script setup>
const experiences = [
  {
    title: 'Software Engineer',
    company: 'PT. Arranet Indonesia Sejahtera',
    dates: 'Aug 2022 - Present',
    location: 'Jakarta, Indonesia',
    items: [
      {
        heading: 'Projects & Achievements',
        points: [
          'PPOB (Payment Point Online Bank): Implemented features for bill payments and product purchases.',
          'BI-FAST: Developed real-time fund transfer features through the BI-FAST system.',
          'QRIS: Implemented national-standard QR code payments, including scanning and real-time notifications.'
        ]
      },
      {
        heading: 'EDC Integration (Topwise T3, Advan C1 Smartpeak)',
        points: [
          'Developed applications for EDC devices, integrating with SDKs for card readers and thermal printers.',
          'Focused on reading and exploring SDK documentation to implement device features.'
        ]
      },
      {
        heading: 'Soundbox Integration (Topwise SP10)',
        points: [
          'Configured the soundbox to receive automated voice transaction notifications using the MQTT protocol.'
        ]
      },
    ],
    technologies: [
      'Kotlin', 'Jetpack Compose', 'MQTT', 'Retrofit', 'Hilt', 'DataStore', 'Git', 'Azure', 'Jira'
    ]
  },
  {
    title: 'Fasilitator Program Digital Talent Scholarship (DTS) 2021',
    company: 'Dicoding Indonesia',
    dates: 'Oct 2021 - Dec 2021 (Seasonal)',
    location: 'Remote',
    items: [
      {
        heading: 'Responsibilities',
        points: [
          'Mentored participants of the DTS ProA 2021 program in the field of Android Development.',
          'Assisted participants in understanding learning materials and provided constructive feedback.',
          'Managed communication and coordination between participants and organizers to ensure smooth training execution.'
        ]
      }
    ],
    technologies: []
  },
  {
    title: 'Fasilitator Program Baparekraf Developer Day (BDD) 2021',
    company: 'Baparekraf Digital Talent',
    dates: 'May 2021 - Jul 2021 (Seasonal)',
    location: 'Remote',
    items: [
      {
        heading: 'Responsibilities',
        points: [
          'Mentored participants of the BDT 2021 program in the field of Android Development.',
          'Guided participants in understanding learning materials and provided constructive feedback.',
          'Managed communication and coordination between participants and organizers.'
        ]
      }
    ],
    technologies: []
  },
  {
    title: 'Android Developer Cohort',
    company: 'Bangkit Academy led by Google, GoTo, & Traveloka',
    dates: 'Feb 2021 - Jul 2021',
    location: 'Remote',
    items: [
      {
        heading: 'Program Focus',
        points: [
          'Completed an intensive 5-month training program focused on Kotlin and Android Jetpack.',
          'Studied Software Engineering Principles including Clean Code, SOLID, and Git.',
          'Developed a capstone project in a cross-domain team (ML & Cloud).',
          'Enhanced soft skills and English communication for industry readiness.'
        ]
      }
    ],
    technologies: ['Kotlin', 'Android Jetpack', 'SOLID', 'Git']
  }
];
</script>

<template>
  <section v-scroll-animation id="experience" class="bg-slate-800 py-16">
    <div class="container mx-auto px-6">
      <!-- Title -->
      <h2 class="text-yellow-400 font-bold text-lg uppercase tracking-widest text-center">
        Work Experience & Programs
      </h2>
      <div class="flex justify-center items-center mt-2 mb-12">
        <span class="w-10 h-0.5 bg-white"></span>
        <span class="w-4 h-0.5 bg-yellow-400 mx-1"></span>
        <span class="w-10 h-0.5 bg-white"></span>
      </div>

      <!-- Experience Cards -->
      <div class="max-w-4xl mx-auto space-y-8">
        <div v-for="(exp, index) in experiences" :key="index" class="bg-slate-700 rounded-lg shadow-lg p-8">
          <!-- Header -->
          <div class="mb-6">
            <h3 class="text-2xl font-bold text-white">{{ exp.title }}</h3>
            <p class="text-yellow-400 font-semibold text-lg">{{ exp.company }}</p>
            <p class="text-gray-400 text-sm">{{ exp.dates }} | {{ exp.location }}</p>
          </div>

          <!-- Details -->
          <div class="space-y-6">
            <div v-for="(item, itemIndex) in exp.items" :key="itemIndex">
              <h4 class="text-lg font-semibold text-white mb-2">{{ item.heading }}</h4>
              <ul class="list-disc list-inside text-gray-300 space-y-1 pl-2">
                <li v-for="(point, pointIndex) in item.points" :key="pointIndex">
                  {{ point }}
                </li>
              </ul>
            </div>
          </div>

          <!-- Technologies -->
          <div v-if="exp.technologies.length > 0" class="mt-8">
            <h4 class="text-lg font-semibold text-white mb-3">Technologies & Tools</h4>
            <div class="flex flex-wrap gap-2">
              <span v-for="(tech, techIndex) in exp.technologies" :key="techIndex" class="bg-slate-600 text-yellow-300 text-xs font-semibold px-3 py-1 rounded-full">
                {{ tech }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
