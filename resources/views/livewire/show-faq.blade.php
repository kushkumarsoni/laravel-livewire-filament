<main>
    <section class="section">
        <div class="container">
          <div class="row justify-content-center mb-5">
            <div class="col-lg-6">
              <div class="section-title text-center">
                <p class="text-primary text-uppercase fw-bold mb-3">Frequient Questions</p>
                <h1>Frequently Asked Questions</h1>
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-lg-9">
              <div class="accordion accordion-border-bottom" id="accordionFAQ">
                @forelse($faqs as $faq)
                    <div class="accordion-item">
                    <h2 class="accordion-header accordion-button h5 border-0 "
                        id="heading-a443e01b4db47b3f4a1267e10594576d52730ec1" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse-a443e01b4db47b3f4a1267e10594576d52730ec1" aria-expanded="false"
                        aria-controls="collapse-a443e01b4db47b3f4a1267e10594576d52730ec1">{{ $faq?->question }}
                    </h2>
                    <div id="collapse-a443e01b4db47b3f4a1267e10594576d52730ec1" class="accordion-collapse collapse border-0 "
                        aria-labelledby="heading-a443e01b4db47b3f4a1267e10594576d52730ec1" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body py-0 content">{!! $faq?->answer !!}</div>
                    </div>
                    </div>
                @empty
                @endforelse
              </div>
            </div>
          </div>
        </div>
      </section>
</main>