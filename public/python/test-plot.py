import matplotlib

matplotlib.use("Agg")  # Mode tanpa GUI untuk Matplotlib

import matplotlib.pyplot as plt
import os
import numpy as np

x = np.random.randn(5)
y = np.random.randn(5)

# Membuat plot
plt.plot(x, y)

# Menyimpan plot
plt.savefig(os.path.join(os.path.dirname(__file__), "../assets/myplot.png"))
