<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<style>
    body { background-color: #05080f; font-family: 'Poppins', sans-serif; color: white; }
    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        transition: 0.4s;
    }
    .text-gradient {
        background: linear-gradient(90deg, #38bdf8, #818cf8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .back-btn {
        text-decoration: none;
        color: #94a3b8;
        font-weight: 500;
        transition: 0.3s;
    }
    .back-btn:hover { color: #38bdf8; }
    .img-hover { transition: 0.5s; cursor: pointer; }
    .img-hover:hover { transform: scale(1.05); }
</style>

<div class="container py-5">
    <a href="index.php" class="back-btn mb-4 d-inline-block">
        <i class="bi bi-arrow-left"></i> Back to Home
    </a>

    <div class="row align-items-center g-5 mt-2">
        <div class="col-lg-6">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 mb-3 rounded-pill">OUR MISSION</span>
            <h1 class="display-4 fw-bold mb-4">Freshness Delivered <br><span class="text-gradient">Directly from Farmers</span></h1>
            <p class="text-secondary fs-5" style="line-height: 1.8;">
                आम्ही तंत्रज्ञान आणि शेतीची सांगड घालून एक असा मंच तयार केला आहे, जिथे ग्राहकांना विषमुक्त, नैसर्गिक आणि ताजी फळे थेट शेतकऱ्यांकडून मिळतील. आमचा उद्देश शेतकऱ्यांचा नफा वाढवणे आणि तुम्हाला सर्वोत्तम दर्जा देणे हा आहे.
            </p>
            
            <div class="row g-4 mt-2">
                <div class="col-6">
                    <div class="glass-card p-3">
                        <i class="bi bi-shield-check fs-2 text-info"></i>
                        <h6 class="mt-2 fw-bold">100% Organic</h6>
                        <small class="text-muted">No chemicals used</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="glass-card p-3">
                        <i class="bi bi-truck fs-2 text-info"></i>
                        <h6 class="mt-2 fw-bold">Fast Delivery</h6>
                        <small class="text-muted">Within 24 hours</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="position-relative">
                <img src="https://images.unsplash.com/photo-1610832958506-aa56368176cf?auto=format&fit=crop&q=80&w=1000" 
                     class="img-fluid rounded-5 shadow-lg img-hover border border-secondary" alt="Fresh Fruits">
                <div class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-success p-3 shadow-lg">
                    Best Price Guaranteed
                </div>
            </div>
        </div>
    </div>
</div>