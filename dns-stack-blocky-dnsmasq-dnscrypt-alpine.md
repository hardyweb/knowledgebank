---
id: dns-stack-blocky-dnsmasq-dnscrypt-alpine
type: knowledge
date: 2026-04-19
topics: [dns, networking, linux, devops, security]
tags: [blocky, dnsmasq, dnscrypt-proxy, alpine-linux, dns-filtering, encrypted-dns]
source: conversation
---

# DNS Stack: Blocky + dnsmasq + dnscrypt-proxy (Alpine/Linux)

## Summary
A modular DNS architecture combining `dnsmasq`, `Blocky`, and `dnscrypt-proxy` provides local DNS resolution, filtering, caching, and encrypted upstream queries. Proper port separation and loopback binding prevent conflicts with container networking (e.g., Incus) and ensure predictable behavior.

---

## Key Concepts

* **Layered DNS architecture**
  - `dnsmasq`: DHCP + local DNS (port 53)
  - `Blocky`: filtering, caching (custom port, e.g. 15353)
  - `dnscrypt-proxy`: encrypted upstream (custom port, e.g. 5053)

* **Port separation**
  - Avoid conflicts with system services (e.g., Incus `dnsmasq`)
  - Use high ports for internal chaining (15353, 5053)

* **Loopback binding**
  - Bind services to `127.0.0.1` to reduce attack surface
  - Prevent unintended exposure on external interfaces

* **Upstream configuration requirements**
  - Must use full IPs (e.g., `1.1.1.1`, not `1.1`)
  - Invalid upstreams cause resolution failure

* **Protocol behavior**
  - DNS UDP is default; TCP used for fallback/debug
  - Timeout on UDP often indicates port conflict or firewall issue

* **Blocky config evolution**
  - Deprecated keys replaced with:
    - `upstream` → `upstreams.groups`
    - `port` → `ports.dns`
    - `blocking.blackLists` → `blocking.denylists`

* **Encrypted DNS**
  - `dnscrypt-proxy` provides DNSCrypt (and optional DoH)
  - Improves privacy and integrity of DNS queries

* **Testing strategy**
  - Validate each layer independently:
    1. dnscrypt-proxy
    2. Blocky
    3. dnsmasq
    4. system resolver

---

## Implementation / Example code

### 1. dnscrypt-proxy (Alpine)

```toml
# /etc/dnscrypt-proxy/dnscrypt-proxy.toml
listen_addresses = ['127.0.0.1:5053']

server_names = ['quad9-dnscrypt-ip4-filter-pri', 'quad9-dnscrypt-ip4-filter-alt']

ipv6_servers = false
dnscrypt_servers = true
doh_servers = false

require_dnssec = true
require_nolog = true
require_nofilter = false

Start service:

rc-update add dnscrypt-proxy
rc-service dnscrypt-proxy start

Test:

dig @127.0.0.1 -p 5053 google.com
2. Blocky configuration
ports:
  dns: 15353

listen:
  - 127.0.0.1

upstreams:
  groups:
    default:
      - tcp+udp:127.0.0.1:5053
  timeout: 5s

blocking:
  denylists:
    ads:
      - https://raw.githubusercontent.com/StevenBlack/hosts/master/hosts
  clientGroupsBlock:
    default:
      - ads

caching:
  minTime: "5m"
  maxTime: "1h"
  prefetching: true
```
Test:

dig @127.0.0.1 -p 15353 google.com
3. dnsmasq forwarding
# /etc/dnsmasq.d/blocky.conf
server=127.0.0.1#15353
no-resolv

Restart:

systemctl restart dnsmasq

Test:

dig google.com
4. Debugging commands
# Check listening ports
ss -lntup | grep -E '53|15353|5053'

# Test UDP vs TCP
dig @127.0.0.1 -p 15353 google.com
dig +tcp @127.0.0.1 -p 15353 google.com

# Packet inspection
tcpdump -i lo udp port 15353
5. Common Risks
Port conflicts (e.g., Incus using UDP 5353)
Misconfigured upstream (invalid IP format)
Firewall blocking UDP
Deprecated Blocky config keys
Broken denylist sources (parse errors)
6. Data Flow Overview
Client → dnsmasq:53 → Blocky:15353 → dnscrypt-proxy:5053 → Quad9

This setup ensures:

Centralized filtering (Blocky)
Encrypted upstream (dnscrypt-proxy)
Compatibility with container networking (dnsmasq/Incus)
Clear debugging boundaries
