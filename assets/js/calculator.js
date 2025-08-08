/**
 * Price Calculator JavaScript
 * Alumpro.Az Management System
 */

class PriceCalculator {
    constructor() {
        this.prices = {
            profiles: {
                '50mm': 22.50,
                '60mm': 25.50,
                '70mm': 28.50
            },
            glass: {
                'single': 15.00,
                'double': 45.00,
                'triple': 75.00
            },
            accessories: {
                'euro_handle': 85.00,
                'mosquito_net': 25.00,
                'window_sill': 35.00 // per meter
            },
            installation: {
                'window': 25.00, // per m²
                'door': 35.00    // per m²
            }
        };

        this.currentCalculation = {
            productType: 'window',
            width: 120,
            height: 140,
            profileType: '50mm',
            glassType: 'double',
            accessories: ['euro_handle'],
            quantity: 1
        };

        this.init();
    }

    init() {
        this.bindEvents();
        this.updateResults();
    }

    bindEvents() {
        // Product type change
        document.querySelectorAll('input[name="product_type"]').forEach(input => {
            input.addEventListener('change', (e) => {
                this.currentCalculation.productType = e.target.value;
                this.updateResults();
            });
        });

        // Dimensions change
        const widthInput = document.getElementById('width');
        const heightInput = document.getElementById('height');

        [widthInput, heightInput].forEach(input => {
            input.addEventListener('input', () => {
                this.updateDimensions();
                this.updateResults();
            });
        });

        // Profile type change
        document.querySelectorAll('input[name="profile_type"]').forEach(input => {
            input.addEventListener('change', (e) => {
                this.currentCalculation.profileType = e.target.value;
                this.updateResults();
            });
        });

        // Glass type change
        document.querySelectorAll('input[name="glass_type"]').forEach(input => {
            input.addEventListener('change', (e) => {
                this.currentCalculation.glassType = e.target.value;
                this.updateResults();
            });
        });

        // Accessories change
        document.querySelectorAll('input[name="accessories[]"]').forEach(input => {
            input.addEventListener('change', () => {
                this.updateAccessories();
                this.updateResults();
            });
        });

        // Quantity controls
        const quantityInput = document.getElementById('quantity');
        const quantityMinus = document.getElementById('quantityMinus');
        const quantityPlus = document.getElementById('quantityPlus');

        quantityInput.addEventListener('input', () => {
            this.currentCalculation.quantity = parseInt(quantityInput.value) || 1;
            this.updateResults();
        });

        quantityMinus.addEventListener('click', () => {
            const current = parseInt(quantityInput.value) || 1;
            if (current > 1) {
                quantityInput.value = current - 1;
                this.currentCalculation.quantity = current - 1;
                this.updateResults();
            }
        });

        quantityPlus.addEventListener('click', () => {
            const current = parseInt(quantityInput.value) || 1;
            if (current < 50) {
                quantityInput.value = current + 1;
                this.currentCalculation.quantity = current + 1;
                this.updateResults();
            }
        });

        // Calculate button
        document.getElementById('calculateBtn').addEventListener('click', () => {
            this.calculate();
        });

        // Save calculation
        document.getElementById('saveCalculationBtn').addEventListener('click', () => {
            this.saveCalculation();
        });

        // Generate PDF
        document.getElementById('generatePDFBtn').addEventListener('click', () => {
            this.generatePDF();
        });
    }

    updateDimensions() {
        const width = parseInt(document.getElementById('width').value) || 0;
        const height = parseInt(document.getElementById('height').value) || 0;

        this.currentCalculation.width = width;
        this.currentCalculation.height = height;

        // Update dimension display
        const area = (width * height) / 10000; // Convert cm² to m²
        const dimensionDisplay = `${width} x ${height} sm (${area.toFixed(2)} m²)`;
        document.getElementById('dimensionDisplay').textContent = dimensionDisplay;
    }

    updateAccessories() {
        const checkedAccessories = [];
        document.querySelectorAll('input[name="accessories[]"]:checked').forEach(input => {
            checkedAccessories.push(input.value);
        });
        this.currentCalculation.accessories = checkedAccessories;
    }

    updateResults() {
        // Update result display
        document.getElementById('resultProductType').textContent = 
            this.currentCalculation.productType === 'window' ? 'Pəncərə' : 'Qapı';
        
        document.getElementById('resultDimensions').textContent = 
            `${this.currentCalculation.width} x ${this.currentCalculation.height} sm`;
        
        const area = (this.currentCalculation.width * this.currentCalculation.height) / 10000;
        document.getElementById('resultArea').textContent = `${area.toFixed(2)} m²`;
        
        // Profile display
        const profileNames = {
            '50mm': '50mm Profil',
            '60mm': '60mm Profil',
            '70mm': '70mm Profil'
        };
        document.getElementById('resultProfile').textContent = 
            profileNames[this.currentCalculation.profileType];
        
        // Glass display
        const glassNames = {
            'single': 'Tək Şüşə',
            'double': 'İkili Şüşə',
            'triple': 'Üçlü Şüşə'
        };
        document.getElementById('resultGlass').textContent = 
            glassNames[this.currentCalculation.glassType];
        
        document.getElementById('resultQuantity').textContent = 
            `${this.currentCalculation.quantity} ədəd`;

        // Calculate and update costs
        this.calculate();
    }

    calculate() {
        const width = this.currentCalculation.width / 100; // Convert to meters
        const height = this.currentCalculation.height / 100; // Convert to meters
        const area = width * height;
        const perimeter = 2 * (width + height);

        // Profile cost
        const profilePrice = this.prices.profiles[this.currentCalculation.profileType];
        const profileCost = profilePrice * perimeter * this.currentCalculation.quantity;

        // Glass cost
        const glassPrice = this.prices.glass[this.currentCalculation.glassType];
        const glassCost = glassPrice * area * this.currentCalculation.quantity;

        // Accessories cost
        let accessoriesCost = 0;
        this.currentCalculation.accessories.forEach(accessory => {
            if (accessory === 'window_sill') {
                // Window sill is priced per meter (width)
                accessoriesCost += this.prices.accessories[accessory] * width * this.currentCalculation.quantity;
            } else {
                accessoriesCost += this.prices.accessories[accessory] * this.currentCalculation.quantity;
            }
        });

        // Installation cost
        const installationPrice = this.prices.installation[this.currentCalculation.productType];
        const installationCost = installationPrice * area * this.currentCalculation.quantity;

        // Total cost
        const totalCost = profileCost + glassCost + accessoriesCost + installationCost;

        // Update display
        document.getElementById('costProfile').textContent = `${profileCost.toFixed(2)} AZN`;
        document.getElementById('costGlass').textContent = `${glassCost.toFixed(2)} AZN`;
        document.getElementById('costAccessories').textContent = `${accessoriesCost.toFixed(2)} AZN`;
        document.getElementById('costInstallation').textContent = `${installationCost.toFixed(2)} AZN`;
        document.getElementById('totalCost').textContent = `${totalCost.toFixed(2)} AZN`;

        return {
            profileCost,
            glassCost,
            accessoriesCost,
            installationCost,
            totalCost,
            area,
            perimeter
        };
    }

    saveCalculation() {
        const calculation = {
            ...this.currentCalculation,
            result: this.calculate(),
            timestamp: new Date().toISOString(),
            id: this.generateId()
        };

        // Save to localStorage
        const savedCalculations = JSON.parse(localStorage.getItem('savedCalculations') || '[]');
        savedCalculations.push(calculation);
        localStorage.setItem('savedCalculations', JSON.stringify(savedCalculations));

        // Show success message
        this.showNotification('Hesab uğurla yadda saxlandı!', 'success');

        // Optional: Send to server
        this.sendCalculationToServer(calculation);
    }

    async sendCalculationToServer(calculation) {
        try {
            const response = await fetch('/api/calculator/save', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify(calculation)
            });

            if (!response.ok) {
                throw new Error('Failed to save calculation');
            }

            console.log('Calculation saved to server');
        } catch (error) {
            console.error('Error saving calculation:', error);
        }
    }

    generatePDF() {
        const calculation = this.calculate();
        
        // Create PDF content
        const pdfContent = this.generatePDFContent(calculation);
        
        // For now, we'll create a simple HTML version that can be printed
        const printWindow = window.open('', '_blank');
        printWindow.document.write(pdfContent);
        printWindow.document.close();
        printWindow.print();
        
        this.showNotification('PDF hazırlandı. Yüklənməni gözləyin...', 'info');
    }

    generatePDFContent(calculation) {
        const area = (this.currentCalculation.width * this.currentCalculation.height) / 10000;
        const date = new Date().toLocaleDateString('az-AZ');
        
        return `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Qiymət Hesabı - Alumpro.Az</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .header { text-align: center; margin-bottom: 30px; }
                .logo { color: #20B2AA; font-size: 24px; font-weight: bold; }
                .table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                .table th { background-color: #f2f2f2; }
                .total { font-weight: bold; font-size: 18px; }
                .footer { margin-top: 30px; font-size: 12px; color: #666; }
            </style>
        </head>
        <body>
            <div class="header">
                <div class="logo">🏢 Alumpro.Az</div>
                <h2>Qiymət Hesabı</h2>
                <p>Tarix: ${date}</p>
            </div>
            
            <h3>Layihə Məlumatları</h3>
            <table class="table">
                <tr><td>Məhsul növü:</td><td>${this.currentCalculation.productType === 'window' ? 'Pəncərə' : 'Qapı'}</td></tr>
                <tr><td>Ölçülər:</td><td>${this.currentCalculation.width} x ${this.currentCalculation.height} sm</td></tr>
                <tr><td>Sahə:</td><td>${area.toFixed(2)} m²</td></tr>
                <tr><td>Profil sistemi:</td><td>${this.currentCalculation.profileType}</td></tr>
                <tr><td>Şüşə növü:</td><td>${this.currentCalculation.glassType}</td></tr>
                <tr><td>Miqdar:</td><td>${this.currentCalculation.quantity} ədəd</td></tr>
            </table>
            
            <h3>Qiymət Tərkibi</h3>
            <table class="table">
                <tr><td>Profil sistemi:</td><td>${calculation.profileCost.toFixed(2)} AZN</td></tr>
                <tr><td>Şüşə:</td><td>${calculation.glassCost.toFixed(2)} AZN</td></tr>
                <tr><td>Aksesuarlar:</td><td>${calculation.accessoriesCost.toFixed(2)} AZN</td></tr>
                <tr><td>Quraşdırma:</td><td>${calculation.installationCost.toFixed(2)} AZN</td></tr>
                <tr class="total"><td>CƏMİ:</td><td>${calculation.totalCost.toFixed(2)} AZN</td></tr>
            </table>
            
            <div class="footer">
                <p>Bu qiymət təxminidir. Dəqiq qiymət üçün bizimlə əlaqə saxlayın.</p>
                <p>Telefon: +994 XX XXX XX XX | Email: info@alumpro.az</p>
                <p>WhatsApp: +994 XX XXX XX XX | Web: alumpro.az</p>
            </div>
        </body>
        </html>
        `;
    }

    generateId() {
        return 'calc_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
    }

    showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} notification-toast`;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            animation: slideInRight 0.3s ease-out;
        `;
        notification.textContent = message;

        // Add to page
        document.body.appendChild(notification);

        // Auto remove
        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.3s ease-in';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    // Load saved calculations (for future implementation)
    loadSavedCalculations() {
        return JSON.parse(localStorage.getItem('savedCalculations') || '[]');
    }

    // Get calculation by ID (for future implementation)
    getCalculationById(id) {
        const calculations = this.loadSavedCalculations();
        return calculations.find(calc => calc.id === id);
    }

    // Delete calculation (for future implementation)
    deleteCalculation(id) {
        const calculations = this.loadSavedCalculations();
        const filtered = calculations.filter(calc => calc.id !== id);
        localStorage.setItem('savedCalculations', JSON.stringify(filtered));
    }
}

// CSS animations for notifications
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(100%); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes slideOutRight {
        from { opacity: 1; transform: translateX(0); }
        to { opacity: 0; transform: translateX(100%); }
    }
    .notification-toast {
        backdrop-filter: blur(10px);
    }
`;
document.head.appendChild(style);

// Initialize calculator when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.priceCalculator = new PriceCalculator();
});

// Export for use in other modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = PriceCalculator;
}